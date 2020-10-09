<template>
  <div id="list-users">
    <jumbotron>
      <template v-slot:header>
        <div>
          <h1 class="h1 text-center text-white pt-5">
            Allez c'est ici qu'on recherche les membres les plus
            <del class="text-uppercase">toxic</del>
          </h1>
        </div>
      </template>
    </jumbotron>

    <b-row class="mb-5 justify-content-center">
      <b-col cols="6">

        <form>
          <b-input @input="loadUsers(currentPage)"
                   v-model="username"
                   placeholder="Pseudo"
          ></b-input>
        </form>

      </b-col>
    </b-row>

    <b-container>
      <b-row>
        <b-col cols="6" lg="4" md="4" sm="4" v-for="user in users" :key="user.id">
          <b-card
              :title="user.username"
              :img-src="user.mediaObjects[0] ? `/media/avatars/${user.mediaObjects[0].filePath}` : '/images/gamer.jpg'"
              img-alt="profil photo"
              img-top
              footer-tag="footer"
              tag="article"
              style="min-height: 25rem;max-width: 20rem;"
              class="mb-2"
          >
            <b-card-text>
              <div>
                <span>{{ user.country }} {{ user.age ? user.age + ' ans' : '' }} </span>
                <span v-html="user.slogan"> {{ user.slogan }}</span>
              </div>
            </b-card-text>

            <template v-slot:footer>
              <b-button class="d-flex justify-content-center" :to="{name: 'profile', params:{id: user.id}}"
                        variant="primary">Profil
              </b-button>
            </template>

          </b-card>
        </b-col>
      </b-row>

      <b-row>
        <b-col cols="12">
          <b-pagination
              class="d-flex justify-content-center"
              @change="loadUsers"
              pills
              prev-text="Précédent"
              next-text="Suivant"
              v-model="currentPage"
              :total-rows="rows"
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

export default {
  name: "UsersList",
  components: {Jumbotron},
  data() {
    return {
      users: null,
      rows: 0,
      perPage: 9,
      currentPage: 1,
      username: ''
    }
  },
  beforeMount() {
    this.loadUsers(this.currentPage)
  },
  methods: {
    onChange: function (value, page) {
      if (this.$store.getters.usersSearch[`${value}-${page}`] !== undefined) {
        this.users = this.$store.getters.usersSearch[`${value}-${page}`];
        this.rows = this.$store.getters.usersSearch[`${value}-${page}`]['rows'];

      } else {
        this.$store.dispatch('findAllWithSearch', {value: value, perPage: this.perPage, page: page})
            .then((result) => {
              this.rows = result.data['hydra:totalItems'];
              this.users = this.$store.getters.usersSearch[`${value}-${page}`];
            })
      }
    },
    loadUsers: function (page) {
      this.currentPage = page === "" ? 1 : page
      if (this.username !== "") {
        this.currentPage = this.currentPage !== 1 ? 1 : page
        this.onChange(this.username, this.currentPage);
      } else {
        if (this.$store.getters.allUsers[this.currentPage] === undefined) {
          this.$store.dispatch('findAll', {
            page: page || this.currentPage,
            perPage: this.perPage
          })
              .then((result) => {
                this.rows = result.data['hydra:totalItems']
                this.users = this.$store.getters.allUsers[this.currentPage];
              })
        } else {
          this.users = this.$store.getters.allUsers[this.currentPage];
          this.rows = this.$store.getters.allUsers[this.currentPage]['rows'];
        }
      }
    },
  }
}
</script>