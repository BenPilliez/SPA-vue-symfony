<template>
  <b-row>
    <b-col cols="12" lg="6" md="6" sm="6">
      <h6>Platformes de jeux</h6>
      <span v-for="game in gamePlatforms" :key="game.id" class="pl-2">
        <b-button v-bind:style="{
          'background': `url(${game.platform.iconPath})`,
          'background-size': 'cover',
          'background-repeat': 'no-repeat',
          'background-position': 'center',
          'border': 'none'}"
                  v-show="isShow"
                  class="social-button"
                  :href="game.url"
                  target="_blank"
                  :variant="game.url !== null ? 'link' : ''"
                 @click=" !game.url ? toggleShow($event) : '' ">
        </b-button>
        <span v-show="!isShow"
              @click=" toggleShow($event)">
          {{ game.username }}
        </span>
      </span>
    </b-col>

    <b-col cols="12" lg="6" md="6" sm="6">
      <h6>Réseaux sociaux</h6>
      <span v-for="social in socialPlatforms" :key="social.id" class="pl-2">
        <b-button v-show="isShow" v-bind:style="  {
          'background': `url(${social.platform.iconPath})`,
          'background-size': 'cover',
          'background-repeat': 'no-repeat',
          'background-position': 'center',
          'border': 'none'

        }"
                  class="social-button"
                  :href="social.url"
                  target="_blank"
                  :variant="social.url !== null ? 'link' : '' "
                  @click=" !social.url ? toggleShow($event): '' ">
        </b-button>
        <span v-show="!isShow"
                  @click="toggleShow($event)">
          {{ social.username }}
        </span>
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
  },
  data() {
    return {
      isShow: true,
    }
  },
  methods: {
    toggleShow: function (e) {
      console.log(e)
      /*this.isShow = !this.isShow;*/
    }
  }

}
</script>

<style scoped>

</style>