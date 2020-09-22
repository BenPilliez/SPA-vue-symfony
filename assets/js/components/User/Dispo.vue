<template>
  <b-row class="mt-5">
    <b-col cols="12">
      <h6 class="text-center">Disponibilité</h6>
    </b-col>

    <b-col cols="12">
      <div class="p5" v-for="(value) in dispo">
        <b-row class="mt-4">
          <b-col cols="3">
            {{ value.day }}
          </b-col>
          <b-col cols="9">
            <b-img width="32" height="32" src="/images/dispo/morning.svg"
                   :class="value.morning === true ? 'opacity-5 mr-3' : 'opacity-1 mr-3'"></b-img>
            <b-img width="32" height="32" src="/images/dispo/midday.svg"
                   :class="value.midday === true ? 'opacity-5 mr-3 ' : 'opacity-1 mr-3'"></b-img>
            <b-img width="32" height="32" src="/images/dispo/evening.svg"
                   :class="value.evening === true ? 'opacity-5 mr-3' : 'opacity-1 mr-3'"></b-img>
            <b-img width="32" height="32" src="/images/dispo/night.svg"
                   :class="value.night === true ? 'opacity-5 mr-3' : 'opacity-1 mr-3'"></b-img>
          </b-col>
        </b-row>
      </div>
    </b-col>
  </b-row>
</template>

<script>
export default {
  name: "Dispo",
  props: ['dispo'],
  data() {
    return {
      days: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"]
    }
  }
}
</script>

<style scoped>

</style>