<template>
  <b-modal id="delete-modal" hide-footer>
    <template v-slot:modal-title>
      T'es un traître !
    </template>
    <div class="d-block text-center">
      <p>T'es bien sur de vouloir supprimer ton compte ?</p>
    </div>

    <div class="d-flex justify-content-center">
      <b-button class="mt-3 mr-1 " variant="success"  @click="$bvModal.hide('delete-modal')">Non</b-button>
      <b-button class="mt-3 " variant="danger"  @click="delete_user(user_id)">Oui</b-button>
    </div>

  </b-modal>
</template>

<script>
export default {
  name: "Modal",
  props:['user_id'],
  methods: {
    delete_user(id) {
      this.$store.dispatch('delete', id)
      .then((resp) => {
        localStorage.clear();
        this.$router.push('/')
      })
    }
  }
}
</script>

<style scoped>

</style>