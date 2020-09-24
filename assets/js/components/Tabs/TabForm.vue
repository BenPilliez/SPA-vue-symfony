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
        <b-icon-laptop></b-icon-laptop>
        Config
      </template>
      <form-config :config="user.userConfig"></form-config>
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
import formConfig from "../User/Edit/Config"

export default ({
  name: "TabForm",
  components: {formDetail, formConfig},
  props:{
    user:Object
  }

})
</script>