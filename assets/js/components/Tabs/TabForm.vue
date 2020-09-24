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
        <b-icon-card-image></b-icon-card-image>
        Avatar
      </template>
      <form-avatar :avatar="user.mediaObjects[0]"></form-avatar>
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
    <b-tab>
      <template v-slot:title>
        <b-icon-card-list></b-icon-card-list>
        Platforms
      </template>
      <form-social :social="user.userPlatforms"></form-social>
    </b-tab>
    <b-tab>
      <template v-slot:title>
        <b-icon-key></b-icon-key>
        Sécurité
      </template>
      <form-password></form-password>
    </b-tab>
  </div>

</template>


<script>
import formDetail from "../User/Edit/formDetail";
import formConfig from "../User/Edit/Config"
import formDispo from "../User/Edit/Dispo";
import formSocial from "../User/Edit/Social"
import formAvatar from "../User/Edit/AvatarForm"
import formPassword from "../User/Edit/PasswordForm";

export default ({
  name: "TabForm",
  components: {formDetail, formConfig, formDispo, formSocial, formAvatar,formPassword},
  props: {
    user: Object
  }

})
</script>