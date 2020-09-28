<template>
  <b-container :fluid=true>
    <loader v-if="loading === true" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40"
            objectbg="#999793" opacity="80" name="circular"></loader>
    <notifications class="mt-4" :message="message" group="app"/>
    <router-view v-if="!authUser" ></router-view>
    <sidebar v-if="authUser" :authUser="authUser"></sidebar>
    <cookie></cookie>
    <Footer v-if="authUser"></Footer>

  </b-container>
</template>
<script>

import Sidebar from "../components/Menu/Sidebar"
import Message from "../components/Message/Message";
import Footer from "../components/Footer/Footer";
import {EventBus} from "../helpers/event-bus";
import Cookie from "../components/Cookies/Cookie";

export default {
  name: 'App',
  computed: {
    authUser: function () {
      return this.$store.getters.auth_user;
    },
    message: function () {
      if (this !== undefined && this.$store.getters.message !== null) {
        this.$notify({
          group: 'app',
          type: this.$store.getters.message.type,
          text: this.$store.getters.message.text,
          duration: 10000,
          speed: 1000,
        });
        this.$store.commit('message_null')
      }
      return null;
    },
    loading: function () {
      return !!(this !== undefined && this.$store.getters.loading);
    }
  },
  created() {
    EventBus.$on('logout', (user) => {
      this.$store.commit('auth_user', null)

    })
  },
  components: {Footer, Sidebar, Message,Cookie}
}

</script>

<style>

</style>