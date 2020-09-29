<template>
  <b-table :striped="striped"
           :bordered="bordered"
           :borderless="borderless"
           :outlined="outlined"
           :small="small"
           :hover="hover"
           :dark="dark"
           :fixed="fixed"
           :stacked="stacked"
           :foot-clone="footClone"
           :no-border-collapse="noCollapse"
           :fields="fields"
           :head-variant="headVariant"
           :table-variant="tableVariant"
           :items="items"
           :responsive="responsive">

  </b-table>
</template>

<script>

export default {
  name: "Table",
  props: ['items', 'options', 'fields'],
  data() {
    return {
      striped: false,
      bordered: false,
      borderless: false,
      outlined: false,
      small: false,
      hover: false,
      dark: false,
      fixed: false,
      footClone: false,
      headVariant: null,
      tableVariant: '',
      noCollapse: false,
      stacked: false,
      responsive: false
    }
  }, mounted() {
    for (let option in this.$props.options) {
      if (this.$props.options.hasOwnProperty(option) && this.hasOwnProperty(option)) {
        this[option] = this.$props.options[option];
      }
    }
  }
}

</script>

<style>
.table.b-table.b-table-stacked > tbody > tr > [data-label] > div {
  width: calc(100% - 50%) !important;

}

.table.b-table.b-table-stacked > tbody > tr > [data-label]::before {
  content: attr(data-label)!important;
  width: 50%!important;
  float: left!important;
  overflow-wrap: break-word!important;
  text-align: left !important;

}
</style>