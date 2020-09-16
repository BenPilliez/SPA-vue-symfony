<template>
  <div>
    <jumbotron>
      <template v-slot:header>
        <b-row class="d-lg-block d-md-block d-sm-block d-none">
          <b-col class="d-flex justify-content-center">
            <div class="min-vh-100">
              <h1 class="h1 text-center text-white pt-5">
                Oops, la page est inconnue au bataillon
              </h1>
            </div>
          </b-col>
        </b-row>
      </template>
    </jumbotron>
    <b-container :fluid=true>
      <b-row no-gutters>
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
import Jumbotron from "../../components/Jumbotron/Jumbotron";

export default {
  name: "NotFound",
  components: {Jumbotron}
}
</script>

<style>
</style>