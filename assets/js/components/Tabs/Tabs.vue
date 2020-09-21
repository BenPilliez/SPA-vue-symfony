<template>
  <b-row>
    <b-col cols="12">
      <b-tabs active-nav-item-class="font-weight-bold text-uppercase text-danger"
              content-class="mt-3" justified>
        <b-tab  active>
          <template v-slot:title>
            <b-icon-exclamation-circle></b-icon-exclamation-circle>
            Détails
          </template>
          <u-detail :user="user"></u-detail>
        </b-tab>
        <b-tab >
          <template v-slot:title>
            <b-icon-joystick></b-icon-joystick>
            Jeux
          </template>
        </b-tab>
        <b-tab >
          <template v-slot:title>
            <b-icon-person></b-icon-person>
            Amis
          </template>
        </b-tab>
      </b-tabs>
    </b-col>
  </b-row>
</template>

<script>
import Detail from "../User/Detail";
export default {
  name: "Tabs",
  components: {uDetail:Detail},
  props: {
    user: Object
  }
}
</script>

<style>

</style>