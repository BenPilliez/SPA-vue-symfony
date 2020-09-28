<template>
  <section v-if="user !== undefined">
    <b-row no-gutters>
      <b-col cols="12">
        <jumbotron class="profile-jumbotron">
          <template v-slot:header>
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
                    <b-dropdown-item-button variant="danger">
                      Signaler
                    </b-dropdown-item-button>
                  </div>
                </b-dropdown>
              </b-col>
            </b-row>
            <b-row class="flex-column justify-content-end">
              <b-col cols="12" class="mt-5">
                <b-row class="justify-content-between ">
                  <b-col cols="12" lg="8" md="8" sm="8" class=" d-flex flex-row">
                    <b-avatar badge badge-variant="success" class="d-none d-lg-block d-md-block d-sm-block"
                              :src="user.mediaObjects[0] ? `/media/avatars/${user.mediaObjects[0].filePath}` : '/images/gamer.jpg'"
                              size="12rem"
                              rounded/>

                    <div class="d-flex flex-column p-3 text-white">
                      <h3>{{ user.username }}</h3>
                      <p v-if="user.gamerType" class=" d-block font-italic">{{ user.gamerType }}</p>
                      <p><span v-if="user.gameRegion">{{ user.gameRegion }} - </span>
                        <span v-if="user.country">{{ user.country }}</span></p>
                      <p class="d-block"><span v-if="user.age">{{ user.age }} ans - </span>
                        <span v-if="user.languages">{{ user.languages.join(', ') }}</span></p>
                      <b-button variant="warning" v-if="user.isOwner === false">Ajouter en ami</b-button>
                      <b-button variant="warning"
                                :to=" user.edit === false ? {name:'edit', id:user.id} : {name:'profile', id:user.id}"
                                v-if="user.isOwner">
                        {{ user.edit === false ? 'Editer' : 'Profile' }}
                      </b-button>
                    </div>
                  </b-col>
                  <b-col cols="12" lg="4" md="4" sm="4">
                    <blockquote v-if="!user.slogan" class="blockquote text-center font-italic text-white pt-5">
                      <h4> "Allez vient
                        <br>on est bien"</h4>
                    </blockquote>
                    <blockquote v-html="user.slogan" v-if="user.slogan"
                                class="blockquote text-center font-italic text-white pt-5">
                      <h4>
                        {{ user.slogan }}
                      </h4>
                    </blockquote>
                  </b-col>
                </b-row>
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
import {EventBus} from '../../helpers/event-bus';


export default {
  name: "User",
  components: {Jumbotron},
  data() {
    return {
      user: this.loadUser(this, this.$route.params.id)
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
  }
}
</script>

<style scoped>
</style>