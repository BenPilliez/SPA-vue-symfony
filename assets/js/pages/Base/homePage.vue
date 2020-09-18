<template>
  <div>
    <jumbotron>
      <template v-slot:header>
        <div class="min-vh-100">
          <h1 class="h1 text-center text-white pt-5">
            Trouve des joueurs
            <del class="text-uppercase">toxic</del>
            <br>pour plus de fun et de victoire
          </h1>
        </div>
      </template>
    </jumbotron>
    <b-container>
      <b-row cols="12">
        <b-col cols="12" lg="4" md="4" sm="4" v-for="user in users" :key="user.id">
          <b-card
              :title="user.username"
              :img-src=" user.image ? `/media/avatars/${user.image}` :'/images/gamer.jpg' "
              img-alt="user-image"
              img-top
              tag="article"
              style="max-width: 20rem;"
              class="mb-2"
          >
            <b-card-text>
              {{ user.slogan }}
            </b-card-text>
            <b-button variant="warning" :to="{name: 'profile', params:{id: user.id}}">
              Visiter le profile
            </b-button>

          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>

import Jumbotron from "../../components/Jumbotron/Jumbotron";

export default {
  name: "Home",
  components: {Jumbotron},
  data() {
    return {
      users: null,
    }
  },
  mounted() {
    this.$store.dispatch('findAll')
        .then((resp) => {
          this.users = this.$store.getters.users
        })
        .catch((error) => {
          console.log(error)
        })
  }
}

</script>

<style scoped>

</style>