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
        <b-icon-calendar-event></b-icon-calendar-event>
        Dispo
      </template>
      <form-dispo :dispo="user.userAvailibilities"></form-dispo>
    </b-tab>
  </div>

</template>


<script>
import formDetail from "../User/Edit/formDetail";
import formConfig from "../User/Edit/Config"
import formDispo from "../User/Edit/Dispo";

export default ({
  name: "TabForm",
  components: {formDetail, formConfig, formDispo},
  props: {
    user: Object
  }

})
</script>