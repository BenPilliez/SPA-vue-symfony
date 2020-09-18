<template>
  <div v-if="user !== undefined">
    <b-row no-gutters>
      <b-col cols="12">
        <jumbotron>
          <template v-slot:header>
            <b-row class="flex-column justify-content-between">
              <b-col cols="12">
                <h1 class="h1 text-center text-white pt-5">
                  Allez vient
                  <br>on est bien
                </h1>
              </b-col>
              <b-col cols="12">
                <div class="d-flex flex-row">
                  <b-avatar class="d-none d-lg-block d-md-block d-sm-block"
                            :src="user.image ? `/media/avatars/${user.image}` : '/images/gamer.jpg'" size="12rem"
                            rounded/>

                  <div class="d-flex flex-column p-3 text-white">
                    <h1 class="text-">{{user.username}}</h1>
                  </div>
                  <!--<div class="flex-column">
                    <p>{{user.username}}</p>
                    <p>{{user.age}}</p>
                    <p>{{user.gamerType}}</p>
                  </div>-->
                </div>
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