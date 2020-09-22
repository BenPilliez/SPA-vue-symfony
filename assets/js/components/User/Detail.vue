<template>
  <b-container :fluid="true" class="rounded p-5" id="detail-container">
    <social :game-platforms="filter('game')" :social-platforms="filter('social')"></social>
    <b-row>
      <b-col cols="12">
        <h4>Son slogan</h4>
      </b-col>

      <b-col cols="12">
        <blockquote v-if="user.slogan" class="font-italic"> "{{ user.slogan }}"</blockquote>
        <blockquote v-if="!user.slogan" class="font-italic"> Il avait surement pas d'inspiration ce jour là</blockquote>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Social from "./Social";

export default {
  name: "Detail",
  components: {Social},
  props: {
    user: Object
  },
  methods:{
    filter(type){
      return this.user.userPlatforms.filter(item => item.platform.type === type)
    }
  }
}
</script>

<style scoped>

</style>