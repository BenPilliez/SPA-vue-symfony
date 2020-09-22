<template>
  <div class="mt-8">
    <b-container class="rounded p-5 " id="detail-container">
      <social class="mb-5" :game-platforms="filter('game')" :social-platforms="filter('social')"></social>
      <hr class="w-75 ">
      <b-row class="mt-5">
        <b-col cols="12" lg="6" md="6" sm="6">
          <slogan :slogan="user.slogan"></slogan>
        </b-col>
        <b-col cols="12" lg="6" md="6" sm="6">
          <description :description="user.description"></description>
        </b-col>
      </b-row>
      <hr class="w-75 ">
      <dispo v-if="user.userAvailibilities.length > 0" :dispo="user.userAvailibilities "></dispo>
      <p class="text-center mt-5" v-if="user.userAvailibilities.length === 0">Il faudrait que {{ user.username }} renseigne ces dispo</p>

    </b-container>
    <b-container class="rounded p-5 mt-8" id="config-container">
      <config class="mt-5" v-if="user.userConfig" :config="user.userConfig"></config>
      <p class="text-center" v-if="!user.userConfig">{{ user.username }} n'a pas encore renseigné son avion de
        chasse</p>
    </b-container>
  </div>
</template>

<script>
import Social from "./Social";
import Slogan from "./Slogan";
import Config from "./Config";
import Dispo from "./Dispo";
import Description from "./Description";

export default {
  name: "Detail",
  components: {Social, Slogan, Config, Dispo, Description},
  props: {
    user: Object
  },
  methods: {
    filter(type) {
      return this.user.userPlatforms.filter(item => item.platform.type === type)
    }
  },
}
</script>

<style scoped>

</style>