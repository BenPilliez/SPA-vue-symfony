<template>
  <section v-if="user !== undefined">
    <b-row no-gutters>
      {{ user }}
      <b-col cols="12">
        <jumbotron :user="user" class="profile-jumbotron">
          <template v-slot:header :user="user">
            <b-row>
              <b-col cols="12" class="d-flex flex-row justify-content-end">
                <b-dropdown id="dropdown-dropleft" dropleft variant="bg-light" no-caret>
                  <template v-slot:button-content>
                    <i class="fas fa-ellipsis-v fa-2x text-white"></i>
                  </template>
                  <div v-if="user.isOwner">
                    <b-dropdown-item
                        :to=" user.edit === false ? {name:'edit', id:user.id} : {name:'profile', id:user.id}"
                        class="font-weight-bold text-uppercase "
                    >
                      {{ user.edit === false ? 'Editer' : 'Profile' }}
                    </b-dropdown-item>
                    <b-dropdown-item-btn variant="danger">Delete</b-dropdown-item-btn>
                  </div>
                  <div v-if="!user.isOwner">
                    <b-dropdown-item>
                      <b-button variant="link">Add to friend</b-button>
                    </b-dropdown-item>
                    <b-dropdown-item>
                      <b-button variant="link ">Report</b-button>
                    </b-dropdown-item>
                  </div>
                </b-dropdown>
              </b-col>
            </b-row>
            <b-row class="flex-column justify-content-between">
              <b-col cols="12">
                <blockquote v-if="!user.slogan" class="blockquote text-center text-white pt-5">
                  <h1> Allez vient
                    <br>on est bien</h1>
                </blockquote>
                <h1 v-if="user.slogan" class="h1 text-center text-white pt-5">
                  {{ user.slogan }}
                </h1>
              </b-col>
              <b-col cols="12" class="mt-5">
                <div class="d-flex flex-row">
                  <b-avatar badge badge-variant="success" class="d-none d-lg-block d-md-block d-sm-block"
                            :src="user.image ? `/media/avatars/${user.image}` : '/images/gamer.jpg'" size="12rem"
                            rounded/>

                  <div class="d-flex flex-column p-3 text-white">
                    <h1>{{ user.username }}</h1>
                    <p v-if="user.gamerType" class=" d-block font-italic">{{ user.gamerType }}</p>
                    <p class="d-block" v-if="user.age && user.country">{{ user.age }} - {{ user.country }}</p>
                    <b-button variant="warning">Ajouter en ami</b-button>
                  </div>
                </div>
              </b-col>
            </b-row>
          </template>
        </jumbotron>
      </b-col>
    </b-row>
    <b-container :fluid=true>
      <router-view :user="user"></router-view>
    </b-container>
  </section>
</template>

<script>
import Jumbotron from "../../components/Jumbotron/Jumbotron";

export default {
  name: "User",
  components: {Jumbotron},
  data() {
    return {
      loadedUser: undefined
    }
  },
  computed: {
    user: function () {
      return this.loadedUser
    }
  },
  beforeMount() {
    this.loadUser(this, this.$route.params.id)
  },
  watch: {
    $route() {
      this.loadUser(this, this.$route.params.id);
    }
  },
  methods: {
    loadUser: (vm, id) => {
      vm.$store.dispatch('findBy', {id: id, edit: vm.$route.name === "edit"})
          .then((resp) => {
            vm.loadedUser = vm.$store.getters.users[id];
          })
    }
  }
}
</script>

<style scoped>

</style>