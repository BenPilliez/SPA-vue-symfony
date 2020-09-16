<template>
  <b-button variant="info" v-b-toggle.sidebar-backdrop>
    <b-icon-justify></b-icon-justify>
    <span>Menu</span>
  </b-button>
</template>

<script>
export default {
  name:"ButtonSidebar"
}
</script>

<style>
button{
  position:absolute;
  top:10px;
}
</style>