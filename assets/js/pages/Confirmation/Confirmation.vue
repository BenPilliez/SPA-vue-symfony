<template>
</template>

<script>
export default {
  name: "Confirmation",
  created() {

    if (this.$route.query.success) {
      this.$store.commit('message', {type: 'success', text: 'Ton compte est bien activé'})

    } else if (this.$route.query.error) {
      switch (this.$route.query.error) {
        case 'expiration' :
          this.$store.commit('message', {type: 'error', text: "Ton token est expiré, regénère s'en un via ton compte"})
          break;
        case 'user':
          this.$store.commit('message', {type: 'error', text: "Oula mais tu n'existe pas toi ou alors tu as déjà activé ton compte petit malin"});
          this.$router.push('/404');
          break;
      }

    }
    if (this.$store.getters.auth_user) {
      this.$router.push('/')
    } else {
      this.$router.push('/login')
    }

  }
}
</script>

<style scoped>

</style>