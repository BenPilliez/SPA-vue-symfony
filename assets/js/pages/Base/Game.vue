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

              <b-modal id="rate-modal" hide-footer >
                <template v-slot:modal-title>
                 Note {{game.name}}
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
                          <b-button class="mt-3 mr-1 " variant="secondary"  @click="$bvModal.hide('rate-modal')">Annuler</b-button>
                          <b-button class="mt-3 " variant="success" type="submit" >Noter</b-button>
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
                        required
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
            <h2>{{ game.name }} c'est quoi ça ? </h2>
            <span v-html="game.text"></span>
          </article>
        </b-col>
      </b-row>
    </b-container>

  </div>
</template>

<script>
import Jumbotron from "../../components/Custom/Jumbotron"

export default {
  name: "Game",
  components: {Jumbotron},
  data() {
    return {
      game: null,
      value: null,
      rateState: null,
      nbRate: null,
      rate: null
    }
  },
  beforeMount() {
    this.$store.dispatch('gameById', {id: this.$route.params.id})
        .then((res) => {
          this.game = res;
          this.nbRate = this.game.rates ? this.game.rates.nbRate : 0;
          this.rate = this.game.rates ? this.game.rates.calculatedRate : null
        })
  },
  methods:{
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
        })
        .catch((err) => {

        })

    }
  }
}
</script>

<style scoped>

output{
  background-color: transparent;
}

</style>