<template>

  <div>
    <b-tab active>
      <template v-slot:title>
        <b-icon-exclamation-circle></b-icon-exclamation-circle>
        Détails
      </template>
      <form-detail :user="user"></form-detail>
    </b-tab>
    <b-tab>
      <template v-slot:title>
        <b-icon-joystick></b-icon-joystick>
        Jeux
      </template>
    </b-tab>
    <b-tab>
      <template v-slot:title>
        <b-icon-person></b-icon-person>
        Amis
      </template>
    </b-tab>
  </div>

</template>


<script>
import formDetail from "../User/Edit/formDetail";

export default ({
  name: "TabForm",
  components: {formDetail},
  props:{
    user:Object
  }

})
</script>