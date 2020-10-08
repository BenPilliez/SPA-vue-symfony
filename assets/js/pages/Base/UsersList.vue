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

    <b-container>
      <b-row>
        <b-col cols="6" lg="3" md="3" sm="3" v-for="user in users" :key="user.id">
          <b-card
              :title="user.username"
              :img-src="user.mediaObjects[0] ? `/media/avatars/${user.mediaObjects[0].filePath}` : '/images/gamer.jpg'"
              img-alt="profil photo"
              img-top
              tag="article"
              style="height: 25rem;"
              class="mb-2"
          >
            <b-card-text >
            <div>
              <span>{{user.country}} {{user.age}} </span>
              <span v-html="user.slogan"> {{user.slogan}}</span>
            </div>
            </b-card-text>

            <b-button :to="{name: 'profile', params:{id: user.id}}"
                      variant="primary">Profil
            </b-button>
          </b-card>
        </b-col>

      </b-row>

      <b-row>
        <b-col cols="12">
          <b-pagination
              @change="loadUsers"
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
      perPage: 8,
      currentPage: 1
    }
  },
  beforeMount() {
    this.loadUsers(this.currentPage)
  },
  methods: {
    loadUsers: function (page) {
      if (this.$store.getters.allUsers[page] === undefined) {
        this.$store.dispatch('findAll', {
          page: page,
          perPage: this.perPage
        })
            .then((result) => {
              this.rows = result.data['hydra:totalItems']
              this.currentPage = page
              this.users = this.$store.getters.allUsers[page];
            })
      } else {
        this.users = this.$store.getters.allUsers[page]
      }
    },
  }
}
</script>