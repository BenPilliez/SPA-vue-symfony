<template>
  <b-row class="mt-5">
    <b-col cols="12">
      <h6 class="text-center">Disponibilité</h6>
    </b-col>

    <b-col cols="12">
      <div class="p5" v-for="(value, index) in days">
        <b-row class="mt-4">
          <b-col cols="12" lg="3" md="3" sm="3">
            {{ value }}
          </b-col>
          <b-col cols="12" lg="9" md="9" sm="9" class="d-flex flex-row justify-content-between flex-wrap">
            <b-img width="32" height="32" src="/images/dispo/morning.svg"
                   :class="dispo[index] && dispo[index].morning === true ? 'opacity-5 mr-3' : 'opacity-1 mr-3'"></b-img>
            <b-img width="32" height="32" src="/images/dispo/midday.svg"
                   :class="dispo[index] && dispo[index].midday === true ? 'opacity-5 mr-3 ' : 'opacity-1 mr-3'"></b-img>
            <b-img width="32" height="32" src="/images/dispo/evening.svg"
                   :class="dispo[index] && dispo[index].evening === true ? 'opacity-5 mr-3' : 'opacity-1 mr-3'"></b-img>
            <b-img width="32" height="32" src="/images/dispo/night.svg"
                   :class="dispo[index] && dispo[index].night === true ? 'opacity-5 mr-3' : 'opacity-1 mr-3'"></b-img>
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