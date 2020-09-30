<template>
</template>

<script>
export default {
  name: "Message",
  props: {
    message: Object
  },
  created() {
    console.log(this.message)
    if (this.message !== null) {
      console.log(this.message)

    }
  }
}
</script>

<style scoped>

</style>