<template>
  <span>
    <transition name="slide-fade">
      <b-button v-bind:style="{
          'background': `url(/images/logo/${iconName}.svg)`,
          'background-size': 'cover',
          'background-repeat': 'no-repeat',
          'background-position': 'center',
          'border': 'none'}"
                v-show="isShow"
                class="social-button"
                :href="url === true ? value : ''"
                target="_blank"
                :variant="url === true ? 'link' : ''"
                @click=" url === false ? toggleShow($event) : '' ">
    </b-button>
    </transition>
    <transition name="slide-fade">
        <span class="social-item-span" v-show="!isShow"
              @click=" toggleShow($event)">
              {{ value}}
        </span>
      </transition>
  </span>
</template>

<script>
export default {
  name: 'SocialItem',
  props: {
    value: String,
    iconName: String,
    url: Boolean
  },
  data() {
    return {
      isShow: true,
    }
  },
  methods: {
    toggleShow: function (e) {
      this.isShow = !this.isShow;
    }
  }
}
</script>

<style>

</style>