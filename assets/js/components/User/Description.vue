<template>
  <b-row>
    <b-col cols="12">
      <h6>Description</h6>
    </b-col>
    <b-col cols="12">
      {{ description }}
    </b-col>
  </b-row>
</template>

<script>
export default {
  name: "Description",
  props: {
    description: String || null
  }
}
</script>

<style scoped>

</style>