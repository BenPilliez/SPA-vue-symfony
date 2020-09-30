<template>
  <section v-if="user !== undefined">
    <b-row no-gutters>
      <b-col cols="12">
        <Header :user="user"/>
        <b-alert v-if="user.isVerified === false && user.isOwner === true" :show="show" dismissible variant="danger">
          Tu n'as pas encore activer ton compte, si ton lien est expiré. N'oublie pas que tu n'as que 7 jours pour
          l'activer ou ton compte sera supprimé
          <br>
          <b-button variant="link" @click="verifEmail()">Clique ici</b-button>
          pour envoyer un nouveau lien
        </b-alert>
      </b-col>
    </b-row>
    <b-container :fluid=true>
      <router-view :user="user"></router-view>
    </b-container>
  </section>
</template>

<script>
import Jumbotron from "../../components/Custom/Jumbotron";
import {EventBus} from '../../helpers/event-bus';
import Header from "../../components/User/Header";

export default {
  name: "User",
  components: {Jumbotron, Header},
  data() {
    return {
      user: this.loadUser(this, this.$route.params.id),
      show: true,
    }
  },
  watch: {
    $route() {
      this.loadUser(this, this.$route.params.id);
    }
  },
  created() {
    EventBus.$on('userUpdated', (user) => {
      this.user = this.loadUser(this, this.$route.params.id);
    });
  },
  methods: {
    loadUser: (vm, id) => {
      vm.$store.dispatch('findBy', {id: id, edit: vm.$route.name === "edit", user: vm.$store.getters.users[id] || null})
          .then((resp) => {
            vm.user = vm.$store.getters.users[id];
          })
          .catch((err) => {
            if (err.response.status === 404) {
              vm.$router.push('/404');
            }
          })
    },
    verifEmail() {
      this.$store.dispatch('sendConfirmEmail', {user_id: this.user.id}).then(() => {
        this.show = false;
      })
    }
  }
}
</script>

<style scoped>
</style>