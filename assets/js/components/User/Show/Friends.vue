<template>
  <div>
    {{friends}}
  </div>

</template>

<script>
export default{
  name:"Friends",
  data(){
    return {
      friends: null,
    }
  },
  beforeMount() {
    this.loadFriends(this.$route.params.id)
  },
  methods:{
    loadFriends(userId){
      this.$store.dispatch('friendsList', userId)
      .then((res) => {
        this.friends = res.data
      })
    }
  }
}
</script>