<template>
  <b-row>
    <b-col cols="12" class="text-center pb">
      <h3>Configuration</h3>
    </b-col>
    <b-col cols="12">
      <b-tabs active-nav-item-class="font-weight-bold text-uppercase text-danger"
              content-class="mt-3" justified>
        <b-tab title="PC">
          <Table :items="[{
                CPU: config.cpu,
                CM: config.motherboard,
                CG: config.graphicCard,
                Alimentation: config.power,
                RAM: config.ram,
                Ventirad: config.cooler,
                Ecran: config.screen,
                Clavier: config.keyboard,
                Souris: config.mouse,
                Manette: config.controller
                }]"
                 :options="{
            striped:true,
            stacked: true,
            responsive: true
          }" class="text-white"
          ></Table>
        </b-tab>

        <b-tab title="Console">
          <Table
              :items="[
                  {
                console: config.consoles ?  config.consoles.join(', ') : '',
                screen: config.screen
              }]"
              :options="{
                    striped:true,
                    stacked: true
                  }"
              class="text-white">
          </Table>
        </b-tab>
      </b-tabs>
    </b-col>
  </b-row>

</template>

<script>

import Table from "../../Table/Table";

export default {
  name: "Config",
  components: {Table},
  props: {
    config: Object
  }
}
</script>

<style scoped>

</style>