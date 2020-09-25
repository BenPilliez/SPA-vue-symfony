<template>

  <b-container :fluid="true" class="rounded formEdit">
    <b-form id="form" @submit.stop.prevent="submit">
      <b-row>
        <b-col cols="12">
          <div class="p5" v-for="(value) in dispo">
            <b-row class="mt-4">
              <b-col cols="3">
                {{ value.day}}
              </b-col>
              <b-col cols="9">
              </b-col>
            </b-row>
          </div>
        </b-col>
      </b-row>
      <b-row class="mt-4">
        <b-col cols="12">
          <b-button size="lg" class="w-100" type="submit" variant="success">Mettre à jour</b-button>
        </b-col>
      </b-row>
    </b-form>

  </b-container>
</template>

<script>
export default {
  name: "formDispo",
  props: {
    dispo: Array
  },
  methods: {
    submit() {

      console.log(document.querySelectorAll('input[type="checkbox"]:checked')[0].value)

    }
  },
}
</script>

<style></style>