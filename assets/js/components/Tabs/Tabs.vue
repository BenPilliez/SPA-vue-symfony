<template>
  <b-row>
    <b-col cols="12">
      <b-tabs id="tabs-container" active-nav-item-class="font-weight-bold text-uppercase text-danger"
              content-class="mt-3" justified>
      <tab-detail v-if="!user.edit" :user="user"></tab-detail>
      <tab-form v-if="user.edit" :user="user"></tab-form>
      </b-tabs>
    </b-col>
  </b-row>
</template>

<script>

import TabDetail from "../../components/Tabs/TabDetail"
import tabEdit from "../../components/Tabs/TabForm"

export default {
  name: "Tabs",
  components: {TabDetail, tabEdit},
  props: {
    user: Object
  }
}
</script>

<style>

</style>