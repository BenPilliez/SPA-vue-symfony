<template>
  <div v-if="user !== undefined">
    <b-row no-gutters>
      <b-col cols="12">
        <jumbotron>
          <template  v-slot:header>
            <b-row>
              <b-col cols="12" class="min-vh-80">
                <h1 class="h1 text-center text-white pt-5">
                  Allez vient
                  <br>on est bien
                </h1>
              </b-col>
            </b-row>
            <b-row>
              <b-col cols="12">
                <b-avatar v-if="user.image" :src="`/media/avatars/${user.image}`" rounded/>
                <b-avatar v-if="!user.image" :src="'/images/gamer.jpg'" alt="user-avatar"
                          size="8rem" rounded/>
              </b-col>
            </b-row>
          </template>
        </jumbotron>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Jumbotron from "../../components/Jumbotron/Jumbotron";

export default {
  name: "Profile",
  components: {Jumbotron},
  props: {
    user: Object
  }
}
</script>

<style scoped>

</style>