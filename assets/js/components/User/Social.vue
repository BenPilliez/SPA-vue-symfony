<template>
  <b-row>
    <b-col cols="12" lg="6" md="6" sm="6" >
      <h3>Platformes de jeux</h3>
      <span v-for="game in gamePlatforms" :key="game.id" class="pl-2">
        <b-img width="32" height="32" :src="game.platform.iconPath"></b-img>
      </span>
    </b-col>

    <b-col cols="12" lg="6" md="6" sm="6" >
      <h3>Réseaux sociaux</h3>
      <span v-for="social in socialPlatforms" :key="social.id" class="pl-2">
        <b-img width="32" height="32" :src="social.platform.iconPath"></b-img>
      </span>
    </b-col>
  </b-row>
</template>

<script>
export default {
  name: "Social",
  props: {
    gamePlatforms: Array,
    socialPlatforms: Array
  }

}
</script>

<style scoped>

</style>