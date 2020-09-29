<template>
  <div>
    <jumbotron>
      <template v-slot:header>
        <div>
          <h1 class="h1 text-center text-white pt-5">
            Trouve des joueurs
            <del class="text-uppercase">toxic</del>
            <br>pour plus de fun et de victoire
          </h1>
        </div>
      </template>
    </jumbotron>
    <b-container>
      <b-row>
        <b-col cols="12" lg="4" md="4" sm="4" v-for="user in users" :key="user.id">
          <b-card
              :title="user.username"
              :img-src=" user.mediaObjects[0] ? `/media/avatars/${user.mediaObjects[0].filePath}` :'/images/gamer.jpg' "
              img-alt="user-image"
              img-width="350"
              img-height="200"
              img-top
              tag="article"
              style="max-width: 20rem;"
              class="mb-2"
          >
            <b-card-text v-html="user.slogan">
              {{ user.slogan }}
            </b-card-text>
            <b-button variant="warning" :to="{name: 'profile', params:{id: user.id}}">
              Visiter le profil
            </b-button>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>

import Jumbotron from "../../components/Jumbotron/Jumbotron";
import {EventBus} from "../../helpers/event-bus";

export default {
  name: "Home",
  data() {
    return {
      users: undefined
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
  },
  created() {
    EventBus.$on('userDelete', (user) => {
      this.users = this.$store.getters.users
    })

  },
  components: {Jumbotron},
}

</script>

<style scoped>

</style>