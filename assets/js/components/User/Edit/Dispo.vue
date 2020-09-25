<template>

  <b-container :fluid="true" class="rounded formEdit">
    <b-form id="form" @submit.stop.prevent="submit">
      <b-row>
        <b-col cols="12">
          <div class="p5" v-for="(value, index) in ['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche']">
            <b-row class="mt-4">
              <b-col cols="3">
                {{ value }}
              </b-col>
              <b-col cols="9" class="d-flex flex-row justify-content-between">
                <b-form-checkbox :id='value + "-morning"' :data-day="value" data-partDay="morning"
                                 :name='value + "-morning" ' :checked="dispo[index] ? dispo[index].morning : false "
                >
                  <b-img width="32" height="32" src="/images/dispo/morning.svg"></b-img>
                </b-form-checkbox>

                <b-form-checkbox
                    :id='value + "-midday"' :name='value + "-midday" ' :data-day="value"
                    data-partDay="midday" :checked="dispo[index] ? dispo[index].midday : false "
                >
                  <b-img width="32" height="32" src="/images/dispo/midday.svg"></b-img>
                </b-form-checkbox>
                <b-form-checkbox
                    :id='value + "-evening"' :name='value + "-evening" ' :data-day="value"
                    data-partDay="evening" :checked="dispo[index] ?  dispo[index].evening : false "
                >
                  <b-img width="32" height="32" src="/images/dispo/evening.svg"></b-img>
                </b-form-checkbox>
                <b-form-checkbox
                    :id='value + "-night"' :name='value + "-night" ' :data-day="value" data-partDay="night"
                    :checked="dispo[index] ? dispo[index].night : false "
                >
                  <b-img width="32" height="32" src="/images/dispo/night.svg"></b-img>
                </b-form-checkbox>
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
      let form = {};
      for (let checked of document.querySelectorAll('input[type=checkbox]:checked')) {
        if (form.hasOwnProperty(checked.getAttribute('data-day'))) {
          form[checked.getAttribute('data-day')][checked.getAttribute('data-partDay')] = true
        } else {
          form[checked.getAttribute('data-day')] = {};
          form[checked.getAttribute('data-day')].day = checked.getAttribute('data-day');
          form[checked.getAttribute('data-day')][checked.getAttribute('data-partDay')] = true
        }
      }
      let url = "/api/user_availibilities";
      let method= "POST";
      let user = this.$route.params.id;

      if(this.dispo.length > 0){
        method = "PUT";
        url = `/api/user_availibilities/${this.$route.params.id}`
      }

      this.$store.dispatch('dispo', {form,  url, method, user})
    }
  },
}
</script>

<style></style>