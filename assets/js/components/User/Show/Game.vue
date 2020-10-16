<template>
  <div >
    <b-container>
      <b-row class="mb-2" >
        <b-col cols="12 d-flex justify-content-center ">
          <b-button variant="primary" :to="{name:'games'}">
            Ajouter des jeux
          </b-button>
        </b-col>
      </b-row>
      <b-row>
        <b-col cols="12" md="6" sm="12" lg="4" v-for="item in currentItemsPerPage" :key="item.id">
          <card-game :item="item" :link="{name: 'game', params:{id: item.id}}"
                     :src="item.gameImage ? `/games/${item.gameImage.filePath}` : '' ">
          </card-game>
        </b-col>
      </b-row>

      <b-row>
        <b-col cols="12">
          <b-pagination
              v-if="userGames !== undefined && userGames.length > perPage"
              class="d-flex justify-content-center"
              v-model="currentPage"
              pills
              prev-text="Précédent"
              next-text="Suivant"
              :total-rows="userGames.length"
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
import cardGame from "../../Custom/cardGame";

export default {
  name: "UGame",
  components: {cardGame},
  data() {
    return {
      userGames: [],
      currentPage: 1,
      perPage: 6
    }
  },
  computed: {
    currentItemsPerPage() {
      if (this.userGames !== undefined) {
        return this.userGames.slice((this.currentPage - 1) * this.perPage, (this.currentPage - 1) * this.perPage + this.perPage)
      }
    }
  },
  beforeMount() {
    this.loadUserGame();
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