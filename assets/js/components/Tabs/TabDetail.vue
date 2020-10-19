<template>
  <div>
    <b-tab active>
      <template v-slot:title>
        <b-icon-exclamation-circle></b-icon-exclamation-circle>
        Détails
      </template>
      <u-detail :user="user"></u-detail>
    </b-tab>
    <b-tab>
      <template v-slot:title>
        <b-icon-joystick></b-icon-joystick>
        Jeux
      </template>
      <u-game></u-game>
    </b-tab>
    <b-tab>
      <template v-slot:title>
        <b-icon-person></b-icon-person>
        Amis
      </template>
      <u-friends/>
    </b-tab>
  </div>
</template>

<script>

import Detail from "../User/Show/Detail"
import UGame from "../User/Show/Game"
import Friends from "../User/Show/Friends";

export default {
  name: "tabDetail",
  components: {uDetail: Detail, uGame: UGame, uFriends: Friends},
  props: {
    user: Object
  }
}
</script>

<style>

</style>