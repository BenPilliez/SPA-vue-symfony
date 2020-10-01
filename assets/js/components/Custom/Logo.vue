<template>
  <div :class="options.class" >
    <span v-html="options.title"> </span>
    <span v-for="item in options.items" :key="item" :class="options.spanClass">
      <b-img :width="options.width" :height="options.width" :src="item">
      </b-img>
    </span>
  </div>
</template>

<script>
export default {
  name: "Logo",
  props: {
    options: Object
  }
}
</script>

<style scoped>

</style>