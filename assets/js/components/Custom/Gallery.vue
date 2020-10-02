<template>
  <div class="d-flex justify-content-around flex-wrap">
    <b-form-radio
        v-for="item in items" :key="item.name"
        :checked="item.name === value"
        @change="$emit('input', item.name)"
        name="radios-avatar"
        :value="item.name">
      <template v-slot="label">
        <b-avatar :src="item.filePath" size="4rem"></b-avatar>
      </template>
    </b-form-radio>
  </div>
</template>

<script>
export default {
  name: "Gallery",
  props: {
    items: Array,
    value: '',
  },
  methods: {
    clicked: function () {
      console.log(this.selected)
    }
  }

}
</script>

<style scoped>
.avatar-radios {
  width: 4rem !important;
  height: 4rem !important;
  border-radius: 50% !important;
  background-repeat: no-repeat !important;
  background-size: cover !important;
  background-position: center !important;
}

</style>