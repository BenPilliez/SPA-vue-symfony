<template>
  <!-- Footer -->
  <footer id="site_footer" class="mt-5">
    <b-container>
      <b-row no-gutters>
        <b-col cols="6" class=" mt-5 text-center d-flex flex-column">
          <p>
            N'hésite pas à inviter tes potes, plus on est de fou plus on rit.
          </p>
          <p class="d-inline mt-5 d-flex flex-row justify-content-around">
            <a href="https://www.linkedin.com/in/benjamin-pilliez-bb0624175/" target="_blank"><i class="fab fa-linkedin-in fa-2x"></i></a>
            <a href="https://www.facebook.com/benjamin.pilliez/" target="_blank"><i class="fab fa-facebook-f fa-2x"></i></a>
            <a href="https://github.com/BenPilliez?tab=repositories" target="_blank"> <i class="fab fa-github fa-2x"></i></a>
          </p>
        </b-col>
        <b-col cols="6" class="mt-4">
          <h5 class="text-center">Liens utiles</h5>
          <b-list-group class="list-unstyled text-center">
            <b-list-group-item href="mailto:admin@benpilliez.fr">Me contacter</b-list-group-item>
            <b-list-group-item :to="{name:'mentions'}">Mentions légales</b-list-group-item>
          </b-list-group>
        </b-col>
      </b-row>

      <b-row class="border-top">
        <b-col cols="12" class=" p-3 text-center ">
          Copyright © - Pilliez Benjamin {{ year }}
        </b-col>
      </b-row>
    </b-container>

  </footer>
  <!-- Footer -->
</template>

<script>
export default {
  name: "Footer",
  computed: {
    year: function () {
      let date = new Date();
      return date.getFullYear();
    }

  }
}
</script>

<style scoped>

</style>