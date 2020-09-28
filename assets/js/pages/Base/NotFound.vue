<template>
  <div>
    <b-container :fluid=true>
      <b-row no-gutters>
        <ButtonSidebar class="notfound"></ButtonSidebar>
        <b-col cols="12">
          <b-img
              :src="'/images/404-error.jpg'"
              id="error-404"
          >
          </b-img>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>

import ButtonSidebar from "../../components/Menu/ButtonSidebar"

export default {
  name: "NotFound",
  components: {ButtonSidebar}
}
</script>

<style>
.notfound{
  z-index:1;
}
</style>