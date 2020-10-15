<template>
  <div class="mt-8">
    <b-container>
      <b-row>
        <b-col cols="12" md="6" sm="12" lg="4" v-if="userGames" v-for="item in userGames" :key="item.id">
          <cardList :title="item.name"
                    :src="item.gameImage ? `/games/${item.gameImage.filePath}` : '' ">
            <template v-slot:button>
              <b-button class="d-flex justify-content-center" :to="{name: 'game', params:{id: item.id}}"
                        variant="primary">Voir
              </b-button>
            </template>
          </cardList>
        </b-col>
      </b-row>
    </b-container>
  </div>


</template>

<script>
import cardList from "../../Custom/cardList";

export default {
  name: "UGame",
  components: {cardList},
  data() {
    return {
      userGames: null
    }
  },
  beforeMount() {
    this.loadUserGame()
  },
  methods: {
    loadUserGame() {
      if (this.$store.getters.userGames[this.$route.params.id] !== undefined) {
        this.userGames = this.$store.getters.userGames[this.$route.params.id];
      } else {
        this.$store.dispatch('userGames', this.$route.params.id)
            .then((res) => {
              this.userGames = this.$store.getters.userGames[this.$route.params.id];
            })
      }

    }
  }
}
</script>

<style scoped>

</style>