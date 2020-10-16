<template>
  <div >
    <b-container class="rounded p-5 " id="detail-container">
      <social class="mb-5" v-if="user.userPlatform !== null"
              :game-platforms="{
        steam: user.userPlatform ? user.userPlatform.steam : null,
        origin: user.userPlatform ? user.userPlatform.origin : null,
        ubisoft: user.userPlatform ? user.userPlatform.ubisoft : null,
        battlenet: user.userPlatform ? user.userPlatform.battlenet : null,
        gog: user.userPlatform ? user.userPlatform.gog : null,
        lol: user.userPlatform ? user.userPlatform.lol : null,
        nintendo: user.userPlatform ? user.userPlatform.nintendo : null,
        psn: user.userPlatform ? user.userPlatform.psn : null,
        rockstar: user.userPlatform ? user.userPlatform.rockstar : null,
        wargaming: user.userPlatform ? user.userPlatform.wargaming : null,
        xbox: user.userPlatform ? user.userPlatform.xbox : null
      }"
              :social-platforms="{   snapchat: user.userPlatform ? user.userPlatform.snapchat : null,
        instagram: user.userPlatform ? user.userPlatform.instagram : null,
        facebook: user.userPlatform ? user.userPlatform.facebook : null,
        twitter: user.userPlatform ? user.userPlatform.twitter : null,
        skype: user.userPlatform ? user.userPlatform.skype : null,
        twitch: user.userPlatform ? user.userPlatform.twitch : null,
        youtube: user.userPlatform ? user.userPlatform.youtube : null}"></social>
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
      gamePlatforms: null,
      socialPlatforms: null,

    }
  },
  methods: {
    Platforms: function () {
      this.socialPlatforms = {};

    }
  }

}
</script>

<style scoped>

</style>