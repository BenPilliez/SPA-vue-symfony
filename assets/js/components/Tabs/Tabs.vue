<template>
    <b-col cols="12">
      <b-tabs id="tabs-container" active-nav-item-class="font-weight-bold text-uppercase text-danger"
              content-class="mt-3" justified>
      <tab-detail v-if="$route.name === 'profile'" :user="user"></tab-detail>
      <tab-form v-if="$route.name === 'edit' " :user="user"></tab-form>
      </b-tabs>
    </b-col>
</template>

<script>

import TabDetail from "../../components/Tabs/TabDetail"
import tabForm from "../../components/Tabs/TabForm"

export default {
  name: "Tabs",
  components: {TabDetail, tabForm},
  props: {
    user: Object
  }
}
</script>

<style>

</style>