<template>
  <div id="homePage">
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
      <b-row class="rounded mt-5" id="registrations">
        <b-col cols="12" lg="12" md="12" sm="12" class="text-center pt-3 pt-lg-5">
          <h3>Pour le moment gamer-app c'est </h3>
          <p class="mt-lg-5 mt-md-5 mt-sm-5 "><strong class="pt-3">{{ registrations }}</strong> <br>joueurs d'inscrit
          </p>
        </b-col>
        <b-col cols="12" lg="12" md="12" sm="12" class="text-center pt-3 pt-lg-5 pb-3">

          <logo :options="optionsConsole"></logo>

         <logo :options="optionsLogo"></logo>
        </b-col>
      </b-row>

      <b-row class="mt-8 rounded text-center " id="favorite-games" v-if="favoriteGames">
        <b-col cols="12">
          <h3>Les jeux les plus appréciés en ce moment </h3>
          <c-swiper :options="optionsSlider" :items="favoriteGames" :banner="true"></c-swiper>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>

import Jumbotron from "../../components/Custom/Jumbotron";
import Swiper from "../../components/Custom/Swiper";
import Logo from "../../components/Custom/Logo"

export default {
  name: "Home",
  data() {
    return {
      registrations: null,
      favoriteGames: null,
      optionsConsole:{
        width:40,
        height:40,
        title:'<h3>Tu peux trouver des joueurs sur</h3>',
        spanClass:'pl-2',
        class:'',
        items:[
          "/images/consoles/ps3.svg","/images/consoles/ps4.svg",
          "/images/consoles/psp.svg","/images/consoles/wii-u.svg",
          "/images/consoles/nintendo-ds.svg","/images/logo/xbox.svg"
        ]
      },
      optionsLogo:{
        width:40,
        height:40,
        class:'mt-lg-5 mt-md-5  mb-2',
        spanClass:'pl-2',
        title:'<p class="white">Et des platforms comme </p>',
        items:[
            "/images/logo/steam.svg","/images/logo/ubisoft.svg",
            "/images/logo/GOG.svg","/images/logo/origin.svg","/images/logo/wargaming.svg"
        ]
      },
      optionsSlider: {
        loop: true,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        breakpoints: {
          1024: {
            slidesPerView: 2,
            spaceBetween: 20
          },
          640: {
            slidesPerView: 1,
            spaceBetween: 10
          },
          320: {
            slidesPerView: 1,
            spaceBetween: 10
          }
        }
      }
    }
  },
  mounted() {
    this.loadRegistrations();
    this.loadFavoriteGames();
  },
  methods: {
    loadRegistrations: function () {
      if (this.$store.getters.registrations !== null) {
        this.registrations = this.$store.getters.registrations
      } else {
        this.$store.dispatch('registrations')
            .then((resp) => {
              this.registrations = this.$store.getters.registrations
            })
      }
    },
    loadFavoriteGames() {
      if (this.$store.getters.registrations !== null) {
        this.favoriteGames = this.$store.getters.favorite
      } else {
        this.$store.dispatch('favorite')
            .then((resp) => {
              this.favoriteGames = this.$store.getters.favorite
            })
      }
    }
  },
  components: {Jumbotron, cSwiper: Swiper,Logo},
}

</script>

<style scoped>

</style>