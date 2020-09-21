<template>
  <div>

    <div class="mt-3">
      <span v-for="game in gamePlatforms" :key="game.id" class="pl-2">
        <b-img width="32" height="32" :src="game.platform.iconPath"></b-img>
      </span>
    </div>

    <div class="mt-5">
      <span v-for="social in socialPlatforms" :key="social.id" class="pl-2">
        <b-img width="32" height="32" :src="social.platform.iconPath"></b-img>
      </span>
    </div>

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