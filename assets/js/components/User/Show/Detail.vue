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
        steam: this.user.userPlatform ? this.user.userPlatform.steam : null,
        origin: this.user.userPlatform ? this.user.userPlatform.origin : null,
        ubisoft: this.user.userPlatform ? this.user.userPlatform.ubisoft : null,
        battlenet: this.user.userPlatform ? this.user.userPlatform.battlenet : null,
        gog: this.user.userPlatform ? this.user.userPlatform.gog : null,
        lol: this.user.userPlatform ? this.user.userPlatform.lol : null,
        nintendo: this.user.userPlatform ? this.user.userPlatform.nintendo : null,
        psn: this.user.userPlatform ? this.user.userPlatform.psn : null,
        rockstar: this.user.userPlatform ? this.user.userPlatform.rockstar : null,
        wargaming: this.user.userPlatform ? this.user.userPlatform.wargaming : null,
        xbox: this.user.userPlatform ? this.user.userPlatform.xbox : null
      },
      socialPlatforms:
          {
            snapchat: this.user.userPlatform ? this.user.userPlatform.snapchat : null,
            instagram: this.user.userPlatform ? this.user.userPlatform.instagram : null,
            facebook: this.user.userPlatform ? this.user.userPlatform.facebook : null,
            twitter: this.user.userPlatform ? this.user.userPlatform.twitter : null,
            skype: this.user.userPlatform ? this.user.userPlatform.skype : null,
            twitch: this.user.userPlatform ? this.user.userPlatform.twitch : null,
            youtube: this.user.userPlatform ? this.user.userPlatform.youtube : null
          }
    }
  }

}
</script>

<style scoped>

</style>