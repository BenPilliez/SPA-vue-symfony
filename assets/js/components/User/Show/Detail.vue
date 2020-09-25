<template>
  <div class="mt-8">
    <b-container class="rounded p-5 " id="detail-container">
      <social class="mb-5" v-if="user.userPlatform !== null" :game-platforms="gamePlatforms"
              :social-platforms="socialPlatforms"></social>
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
      <p class="text-center mt-5" v-if="user.userAvailibilities.length === 0">Il faudrait que {{ user.username }}
        renseigne ces dispo</p>

    </b-container>
    <b-container class="rounded p-5 mt-8" id="config-container">
      <config class="mt-5" v-if="user.userConfig" :config="user.userConfig"></config>
      <p class="text-center" v-if="!user.userConfig">{{ user.username }} n'a pas encore renseigné son avion de
        chasse</p>
    </b-container>
  </div>
</template>

<script>
import Social from "../../Social/Social";
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
  data() {
    return {
      gamePlatforms: {
        steam: this.user.userPlatform.steam,
        origin: this.user.userPlatform.origin,
        ubisoft: this.user.userPlatform.ubisoft,
        battlenet: this.user.userPlatform.battlenet,
        gog: this.user.userPlatform.gog,
        lol: this.user.userPlatform.lol,
        nintendo: this.user.userPlatform.nintendo,
        psn: this.user.userPlatform.psn,
        rockstar: this.user.userPlatform.rockstar,
        wargaming: this.user.userPlatform.wargaming,
        xbox: this.user.userPlatform.xbox
      },
      socialPlatforms:
          {
            snapchat: this.user.userPlatform.snapchat,
            instagram: this.user.userPlatform.instagram,
            facebook: this.user.userPlatform.facebook,
            twitter: this.user.userPlatform.twitter,
            skype: this.user.userPlatform.skype,
            twitch: this.user.userPlatform.twitch,
            youtube: this.user.userPlatform.youtube
          }

    }
  }

}
</script>

<style scoped>

</style>