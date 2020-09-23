<template>
  <b-container :fluid="true" class="formEdit">
    <validation-observer ref="observer" v-slot="{ handleSubmit }">
      <b-form @submit.stop.prevent="handleSubmit(onSubmit)" methods="PUT">
        <b-row>
          <b-col col="6">

            <vue-editor v-model="form.description"></vue-editor>

          </b-col>
        </b-row>
      </b-form>
    </validation-observer>
  </b-container>
</template>

<script>

import {VueEditor} from "vue2-editor";

export default {
  name: "formDetail",
  components: {VueEditor},
  data() {
    return {
      form: {
        slogan: '',
        description: '',
        languages: [],
        gender: '',
        country: '',
        gameRegion: '',
        dateofbirth: '',
        gamerType: '',
      }
    }
  }
}

</script>

<style>

</style>