<template>
  <b-button class="ml-5 button-sidebar" variant="info" v-b-toggle.sidebar-backdrop>
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
.button-sidebar{
  position:absolute;
  top:10px;
}
</style>