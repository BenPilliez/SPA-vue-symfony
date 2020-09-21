<template>
  <div>
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
  </div>
</template>

<script>

import Detail from "../../components/User/Detail"

export default{
  name:"tabDetail",
  components:{uDetail: Detail},
  props:{
    user:Object
  }
}
</script>

<style>

</style>