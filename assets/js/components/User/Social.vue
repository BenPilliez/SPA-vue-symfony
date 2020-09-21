<template>
  <div class="mt-3 rounded p-5" id="social-container">
    <b-row >
      <b-col cols="12">
        <h3>Platformes de jeux</h3>
      </b-col>
      <b-col cols="12">
      <span v-for="game in gamePlatforms" :key="game.id" class="pl-2">
        <b-img width="32" height="32" :src="game.platform.iconPath"></b-img>
      </span>
      </b-col>
    </b-row>

    <b-row class="mt-3">
      <b-col cols="12">
        <h3>Réseaux sociaux</h3>
      </b-col>
      <b-col cols="12">
        <span v-for="social in socialPlatforms" :key="social.id" class="pl-2">
          <b-img width="32" height="32" :src="social.platform.iconPath"></b-img>
        </span>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  name: "Social",
  props: {
    socials: Array
  },
  data() {
    return {
      socialPlatforms: [],
      gamePlatforms: [],
    }
  },

  beforeMount() {
    this.gamePlatforms = this.$props.socials.filter(item => item.platform.type === "game");
    this.socialPlatforms = this.$props.socials.filter(item => item.platform.type === "social");
  }
}
</script>

<style scoped>

</style>