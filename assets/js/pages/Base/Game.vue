<template>
  <div id="game" v-if="game">
    <jumbotron>
      <template v-slot:header>
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
            <h2>{{game.name}} c'est quoi ça ? </h2>
            {{game.text}}
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
      game: null
    }
  },
  beforeMount() {
    this.$store.dispatch('gameById', {id: this.$route.params.id})
        .then((res) => {
          this.game = res;
        })
  }
}
</script>

<style scoped>

</style>