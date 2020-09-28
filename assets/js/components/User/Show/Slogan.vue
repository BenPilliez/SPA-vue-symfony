<template>
  <b-row>
    <b-col cols="12">
      <h6>Slogan</h6>
    </b-col>
    <b-col cols="12">
      <blockquote v-if="slogan" v-html="slogan" class="font-italic"> {{ slogan }}</blockquote>
      <blockquote v-if="!slogan" class="font-italic"> Il avait surement pas d'inspiration ce jour là</blockquote>
    </b-col>
  </b-row>
</template>

<script>
export default {
  name: "Slogan",
  props: {
    slogan: String || null
  }
}
</script>

<style scoped>

</style>