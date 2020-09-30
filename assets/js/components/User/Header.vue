<template>
  <div>
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
                  {{ user.edit === false ? 'Editer' : 'Profil' }}
                </b-dropdown-item>
                <b-dropdown-item-btn variant="danger" @click="$bvModal.show('delete-modal')">Supprimer
                </b-dropdown-item-btn>
                <modal :user_id="user.id"></modal>
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
                    {{ user.edit === false ? 'Editer' : 'Profil' }}
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
  </div>

</template>

<script>
import Jumbotron from "../Custom/Jumbotron";
import Modal from "../Custom/Modal";


export default {
  name: "Header",
  props: {
    user: Object
  },
  components: {Jumbotron,Modal}
}
</script>

<style scoped>

</style>