<template>
  <div>
    <b-sidebar
        class="sidebar"
        id="sidebar-backdrop"
        aria-labelledby="sidebar-no-header-title"
        backdrop
        no-header
        shadow
    >
      <template v-slot:default="{ hide }">
        <div class="p-3">
          <span id="sidebar-no-header-title" class="sidebar-header">
            <router-link
                :to="{name:'home'}"
                class="nav-link"
                @click="hide"
            >
              Gamer-Seek App
            </router-link>
            <b-button class="d-flex justify-content-center align-items-center"
                      variant="primary" block @click="hide"
                      id="dismiss">
              <b-icon-arrow-left-circle></b-icon-arrow-left-circle>
            </b-button>
          </span>
          <nav class="mb-3">
            <b-nav class="components">
              <div class="d-flex">
                <router-link
                    :to="{name: 'profile', params:{id: authUser.id}}"
                    @click="hide"
                >
                  <b-avatar
                      :src="authUser.mediaObjects[0] ? `/media/avatars/${authUser.mediaObjects[0].filePath}` : '/images/gamer.jpg' "
                      alt="user-avatar" size="6rem"
                  />
                </router-link>
                <span class="pt-4 pl-3">Bonjour,<br> {{ authUser.username }}</span>
                <span class="pt-4 pl-3 ">
                  <b-button @click.stop.prevent="logout"
                            class="btn btn-danger"
                  ><i class="fas fa-power-off"></i>
          </b-button></span>
              </div>
            </b-nav>
            <b-nav vertical class="components">
              <router-link
                  :to="{name:'home'}"
                  class="nav-item"
                  @click="hide"
              >
                <b-icon-house></b-icon-house>
                Accueil
              </router-link>
              <router-link
                  :to="{name:'users'}"
                  class="nav-item"
                  @click="hide"
              >
                <b-icon-person></b-icon-person>
                Membres
              </router-link>
              <router-link
                  :to="{name:'games'}"
                  class="nav-item"
                  @click="hide"
              ><b-icon-controller></b-icon-controller>
                Jeux
              </router-link>
              <router-link
                  :to="{name: 'about'}"
                  class="nav-item"
                  @click="hide"
              >
                <b-icon-card-heading></b-icon-card-heading>
                A propos
              </router-link>
            </b-nav>
            <b-list-group class="list-unstyled text-center">
              <b-list-group-item href="mailto:admin@benpilliez.fr">Me contacter</b-list-group-item>
              <b-list-group-item :to="{name:'mentions'}">Mentions légales</b-list-group-item>
            </b-list-group>

            <p class="d-inline mt-5 d-flex flex-row justify-content-around">
              <a href="https://www.linkedin.com/in/benjamin-pilliez-bb0624175/" target="_blank"><i
                  class="fab fa-linkedin-in fa-2x"></i></a>
              <a href="https://www.facebook.com/benjamin.pilliez/" target="_blank"><i
                  class="fab fa-facebook-f fa-2x"></i></a>
              <a href="https://github.com/BenPilliez?tab=repositories" target="_blank"> <i
                  class="fab fa-github fa-2x"></i></a>
            </p>
          </nav>
        </div>
      </template>
    </b-sidebar>
    <router-view>
    </router-view>
  </div>
</template>

<script>
import {EventBus} from "../../helpers/event-bus";

export default {
  name: "Sidebar",
  data() {
    return {
      authUser: this.$store.getters.auth_user
    }
  },
  created() {
    EventBus.$on('userUpdated', (user) => {
      this.authUser = this.$store.getters.auth_user;
    });
  },
  methods: {
    logout: function () {
      this.$store.dispatch('logout')
          .then(() => {
            this.$router.push('/login')
            this.authUser = null;
            EventBus.$emit('logout', this.authUser)
          })
    },
  }
}
</script>

