<template>
  <div>
    <notifications class="mt-4" :message="message" group="app"/>
    <router-view v-if="!authUser"></router-view>
    <sidebar v-if="authUser" :authUser="authUser"></sidebar>
    <Footer v-if="authUser"></Footer>
  </div>
</template>

<script>

import Sidebar from "../components/Menu/Sidebar"
import Message from "../components/Message/Message";
import Footer from "../components/Footer/Footer";

export default {
  name: 'App',
  computed: {
    authUser: function () {
      if (this !== undefined) {
        return this.$store.getters.auth_user;
      }
      return null;
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
    }

  },
  components: {Footer, Sidebar, Message}
}

</script>

<style>

</style>