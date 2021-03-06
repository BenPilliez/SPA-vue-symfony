<template>
  <div id="game" v-if="game">
    <jumbotron>
      <template v-slot:header>
        <b-row>
          <b-col cols="12" class="d-flex flex-row justify-content-end">
            <b-dropdown id="dropdown-dropleft" dropleft variant="bg-light" no-caret>
              <template v-slot:button-content>
                <i class="fas fa-ellipsis-v fa-2x text-white"></i>
              </template>
              <b-dropdown-item-btn @click="$bvModal.show('rate-modal')">Noter
              </b-dropdown-item-btn>
              <b-dropdown-item-btn v-if="checkIfHaveGame === undefined" @click="addToLibrary">Ajouter à ma bibliothèque
              </b-dropdown-item-btn>
              <b-dropdown-item-btn v-if="checkIfHaveGame" variant="danger" @click="deleteFromLibrary">Supprimer de ma
                bibliothèque
              </b-dropdown-item-btn>

              <b-modal id="rate-modal" hide-footer>
                <template v-slot:modal-title>
                  Note {{ game.name }}
                </template>
                <b-container>
                  <b-row class="justify-content-center">
                    <b-col cols="12">
                      <form ref="form" @submit.stop.prevent="handleSubmit">
                        <b-form-group
                            :state="rateState"
                            label="Note"
                            invalid-feedback="Il me faut une note"
                        >
                          <b-form-rating
                              v-model="value"
                              icon-clear="slash-circle"
                              show-clear
                              icon-empty="heart"
                              icon-full="heart-fill"
                              color="#ff8800"
                              required
                              :state="rateState"
                              size="md"
                          />
                        </b-form-group>
                        <div class="d-flex justify-content-center">
                          <b-button class="mt-3 mr-1 " variant="secondary" @click="$bvModal.hide('rate-modal')">
                            Annuler
                          </b-button>
                          <b-button class="mt-3 " variant="success" type="submit">Noter</b-button>
                        </div>
                      </form>
                    </b-col>
                  </b-row>
                </b-container>
              </b-modal>
            </b-dropdown>
          </b-col>
        </b-row>
        <div>
          <h1 class="h1 text-center text-white pt-5">
            {{ game.name }}
          </h1>
        </div>
        <b-row class="flex-column justify-content-end">
          <b-col cols="12" class="mt-8">
            <b-row class="justify-content-between ">
              <b-col cols="12" lg="8" md="8" sm="8" class=" d-flex flex-row">
                <b-img class="d-none d-lg-block d-md-block d-sm-block"
                       :src="game.gameImage ? `/games/${game.gameImage.filePath}` : ''"
                       rounded/>

                <div class="d-flex flex-column p-3 text-white">
                  <h3>{{ game.name }}</h3>
                  <p>
                    <b-form-rating
                        v-if="game.rates"
                        :value="rate"
                        readonly
                        :inline="true"
                        color="#ff8800"
                        precision="1"
                        :state="rateState"
                        no-border
                        size="md"
                    />
                  </p>
                </div>
              </b-col>
            </b-row>
          </b-col>
        </b-row>
      </template>
    </jumbotron>

    <b-container>
      <b-row>
        <b-col cols="12">
          <article>
            <h2 class="text-center">{{ game.name }} c'est quoi ça ? </h2>
            <span v-html="game.text"></span>
          </article>
        </b-col>
      </b-row>
      <b-row class="mt-4" v-if="users !== undefined && users.length > 0">
        <b-col cols="12" class="mt-4 mb-4">
          <h4 class="text-center">Trouve toi des potes sur ce jeu</h4>
        </b-col>
        <b-col cols="12" lg="4" md="6" sm="12" v-for="item in currentItemsPerPage" :key="item.id">
          <card-member class="mb-2"  :item="item"
                       :link="{name: 'profile', params:{id: item.id}}"
                       :src=" item.mediaObjects && item.mediaObjects[0] ? `/media/avatars/${item.mediaObjects[0].filePath}` : '/images/gamer.jpg'">
          </card-member>
        </b-col>
      </b-row>

      <b-row>
        <b-col cols="12">
          <b-pagination
              v-if="users !== undefined && users.length > perPage"
              class="d-flex justify-content-center"
              v-model="currentPage"
              pills
              prev-text="Précédent"
              next-text="Suivant"
              :total-rows="users.length"
              :per-page="perPage"
              first-number
              last-number
          ></b-pagination>
        </b-col>
      </b-row>
    </b-container>

  </div>
</template>

<script>
import Jumbotron from "../../components/Custom/Jumbotron"
import CardMember from "../../components/Custom/cardMember";

export default {
  name: "Game",
  components: {CardMember, Jumbotron},
  data() {
    return {
      game: null,
      value: null,
      rateState: null,
      nbRate: null,
      rate: null,
      users: [],
      currentPage: 1,
      perPage: 6
    }
  },
  computed: {
    currentItemsPerPage() {
      if (this.users !== undefined) {
        return this.users.slice((this.currentPage - 1) * this.perPage, (this.currentPage - 1) * this.perPage + this.perPage)
      }
    },
    checkIfHaveGame() {
      return this.users.find(element => element.id === this.$store.getters.auth_user['id']);
    },
  },
  beforeMount() {
    this.loadUserGames();
    this.$store.dispatch('gameById', {id: this.$route.params.id})
        .then((res) => {
          this.game = res;
          this.nbRate = this.game.rates ? this.game.rates.nbRate : 0;
          this.rate = this.game.rates ? this.game.rates.calculatedRate : null
        })
  },
  methods: {
    checkFormValidity() {
      const valid = this.value !== null
      this.rateState = valid
      return valid
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault()
      // Trigger submit handler
      this.handleSubmit()
    },
    handleSubmit() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return
      }
      this.nbRate += 1;
      let rateValue = this.game.rates ? this.game.rates.rate : 0;
      let rate = parseInt(rateValue) + this.value

      let form = {
        nbRate: this.nbRate,
        rate: rate,
        url: this.game.rates ? this.game.rates['@id'] : `/api/rate_games`,
        method: this.game.rates ? "PUT" : "POST",
        game: this.game['@id']
      }
      this.$store.dispatch('rate', form)
          .then((res) => {
            this.game.rates = res.data;
            this.rate = res.data.calculatedRate;
            this.$store.commit('games', this.game)
            this.value = null;
            this.$bvModal.hide('rate-modal');
            this.$store.commit('favorite', null);
          })

    },
    loadUserGames() {
      if (this.$store.getters.gamesUsers[this.$route.params.id]) {
        this.users = this.$store.getters.gamesUsers[this.$route.params.id];
      } else {
        this.$store.dispatch('gamesUser', this.$route.params.id)
            .then(() => {
              this.users = this.$store.getters.gamesUsers[this.$route.params.id];
            })
      }
    },
    addToLibrary() {
      let auth_user = this.$store.getters.auth_user;
      this.$store.dispatch('addToLibrary', {
        game: this.$route.params.id,
        users: auth_user['@id'],
        user: auth_user['id']
      })
          .then((res) => {
          })
    },
    deleteFromLibrary() {
      this.$store.dispatch('deleteFromLibrary', {
        game: this.$route.params.id,
        user: this.$store.getters.auth_user['id']
      })
          .then((res) => {
            this.users = this.$store.getters.gamesUsers[this.$route.params.id];
          })
    }
  }
}
</script>

<style scoped>

output {
  background-color: transparent;
}

</style>