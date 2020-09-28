<template>
  <div v-if="user !== undefined">
    <Tabs :user="user"></Tabs>
  </div>
</template>

<script>

import Tabs from "../../components/Tabs/Tabs";
export default{
  name:"ProfileEdit",
  components:{Tabs},
  props: {
    user: Object
  },

  beforeMount() {
    if(!this.user.isOwner){
      this.$router.push('/');
    }
  }

}
</script>