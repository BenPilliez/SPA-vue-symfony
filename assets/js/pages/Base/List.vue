<template>
  <div id="list">
    <jumbotron>
      <template v-slot:header>
        <div>
          <h1 class="h1 text-center text-white pt-5" v-html="title"></h1>
        </div>
      </template>
    </jumbotron>

    <b-container>
      <b-row class="mb-5 justify-content-center">
        <b-col cols="12" lg="6" md="6" sm="6">
          <form>
            <b-input @input="loadData(currentPage)"
                     v-model="search"
                     :placeholder="placeholder"
            ></b-input>
          </form>
        </b-col>
      </b-row>

      <b-row>
        <b-col cols="12" lg="4" md="6" sm="12" v-for="item in items" :key="item.id">
          <cardList v-if="type === 'users'" :title="item.username"
                    :src=" item.mediaObjects && item.mediaObjects[0] ? `/media/avatars/${item.mediaObjects[0].filePath}` : '/images/gamer.jpg'">
            <template v-slot:content>
              <div>
                <span>{{ item.country }} {{ item.age ? item.age + ' ans' : '' }} </span>
                <span v-html="item.slogan"> {{ item.slogan }}</span>
              </div>
            </template>

            <template v-slot:button>
              <b-button class="d-flex justify-content-center" :to="{name: 'profile', params:{id: item.id}}"
                        variant="primary">Profil
              </b-button>
            </template>
          </cardList>
          <cardList v-if="type === 'games'" :title="item.name"
                    :src="item.gameImage ? `/games/${item.gameImage.filePath}` : '' ">
            <template v-slot:button>
              <b-button class="d-flex justify-content-center" :to="{name: 'game', params:{id: item.id}}"
                        variant="primary">Voir
              </b-button>
            </template>
          </cardList>
        </b-col>
      </b-row>

      <b-row>
        <b-col cols="12">
          <b-pagination
              class="d-flex justify-content-center"
              @change="loadData"
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
import CardList from "../../components/Custom/cardList";

export default {
  name: "List",
  components: {Jumbotron, CardList},
  data() {
    return {
      items: null,
      rows: 0,
      perPage: 9,
      currentPage: 1,
      search: '',
      placeholder: '',
      type: '',
      title: '',
    }
  },
  watch: {
    $route() {
      this.checkType(this.$route.name)
      this.loadData(this.currentPage)
    }
  },
  beforeMount() {
    this.checkType(this.$route.name)

    this.loadData(this.currentPage)
  },
  methods: {
    checkType: function (route) {
      if (route === "users") {
        this.type = "users";
        this.placeholder = "Pseudo";
        this.title = "Allez c'est ici qu'on recherche les membres les plus <del class='text-uppercase'>toxic</del>"
      }
      if (route === "games") {
        this.type = "games";
        this.placeholder = "Nom du jeu";
        this.title = "Tu recherches un jeu ?"

      }
    },
    onChange: function (value, page, type, url) {
      if (this.$store.getters.search[type] !== undefined && this.$store.getters.search[type][`${value}-${page}`] !== undefined) {
        this.items = this.$store.getters.search[type][`${value}-${page}`];
        this.rows = this.$store.getters.search[type][`${value}-${page}`]['rows'];

      } else {
        this.$store.dispatch('findAllWithSearch', {
          value: value,
          perPage: this.perPage,
          page: page,
          type: type,
          url: url
        })
            .then((result) => {
              this.rows = result.data['hydra:totalItems'];
              this.items = this.$store.getters.search[this.type][`${value}-${page}`];

            })
      }
    },
    loadData: function (page) {
      this.currentPage = page === "" ? 1 : page

      let url = this.type === "users" ? "/api/users" : "/api/games"
      if (this.search !== "") {
        this.currentPage = this.currentPage !== 1 ? 1 : page
        this.onChange(this.search, this.currentPage, this.type, url);
      } else {
        if (this.$store.getters.all[this.type] === undefined || this.$store.getters.all[this.type][this.currentPage] === undefined) {
          this.$store.dispatch('findAll', {
            page: page || this.currentPage,
            perPage: this.perPage,
            type: this.type,
            url: url
          })
              .then((result) => {
                this.rows = result.data['hydra:totalItems']
                this.items = this.$store.getters.all[this.type][this.currentPage];
              })
        } else {
          this.items = this.$store.getters.all[this.type][this.currentPage];
          this.rows = this.$store.getters.all[this.type][this.currentPage]['rows'];
        }
      }
    },
  }
}
</script>