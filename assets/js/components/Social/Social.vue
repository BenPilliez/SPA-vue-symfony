<template>
  <b-row>
    <b-col cols="12" lg="6" md="6" sm="6">
      <h6>Platformes de jeux</h6>

      <span v-for="(game, propertyName) in gamePlatforms" v-if="game.length > 0" :key="propertyName" class="pl-2">
        <social-item  :value="game" :icon-name="propertyName" :url="regex(game)"></social-item>
      </span>
    </b-col>

    <b-col cols="12" lg="6" md="6" sm="6">
      <h6>Réseaux sociaux</h6>
      <span v-for="(social, propertyName) in socialPlatforms" v-if="social.length > 0" :key="propertyName" class="pl-2">
        <social-item v-if="social !== ''" :value="social" :icon-name="propertyName" :url="regex(social)"></social-item>
      </span>
    </b-col>

    <hr class="w-75 ">

  </b-row>
</template>

<script>
import SocialItem from "./SocialItem";

export default {
  name: "Social",
  props: {
    gamePlatforms: Object,
    socialPlatforms: Object
  },
  components: {SocialItem},
  methods:{
    regex: function(value){
       return /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(value);
    }
  }

}
</script>

<style scoped>

</style>