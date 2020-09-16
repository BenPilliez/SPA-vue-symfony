<template>
<div>
  <jumbotron>
    <template v-slot:header>
      <div class="min-vh-100">
        <h1 class="h1 text-center text-white pt-5">
          Trouve des joueurs
          <del class="text-uppercase">toxic</del>
          <br>pour plus de fun et de victoire
        </h1>
      </div>
    </template>
  </jumbotron>
</div>
</template>

<script>

import Jumbotron from "../../components/Jumbotron/Jumbotron";

export default {
  name: "Home",
  components:{Jumbotron}
}

</script>

<style scoped>

</style>