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
                            :src="authUser.image ? `/media/avatars/${authUser.image.filePath}` : '/images/gamer.jpg' "
                            alt="user-avatar" size="6rem"
                  />
                </router-link>
                <span class="pt-4 pl-3">Bonjour,<br> {{ authUser.username }}</span>
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
                  :to="{name: 'about'}"
                  class="nav-item"
                  @click="hide"
              >
                <b-icon-card-heading></b-icon-card-heading>
                A propos
              </router-link>
              <div class="mb-3">
                <a v-b-toggle href="#games-collapse" @click.prevent>
                  <b-icon-controller></b-icon-controller>
                  Jeux</a>
              </div>
              <b-collapse id="games-collapse">
                <b-card>
                  <router-link
                      :to="{name:'seek_games'}"
                      class="nav-item"
                      @click="hide"
                  >Rechercher un jeu
                  </router-link>
                </b-card>
              </b-collapse>
            </b-nav>
          </nav>
        </div>
      </template>
      <template v-slot:footer="{ hide }">
        <div class="d-flex bg-dark text-light align-items-center px-3 py-2">
          <a @click.prevent="logout"
             class="btn btn-danger btn-lg w-100"
          >Logout</a>
        </div>
      </template>
    </b-sidebar>
    <router-view>
    </router-view>
  </div>
</template>

<script>
export default {
  name: "Sidebar",
  props: {
    authUser: Object
  },
  methods: {
    logout: function () {
      this.$store.dispatch('logout')
          .then(() => {
            this.$router.push('/login')
          })
    },
  }
}
</script>

