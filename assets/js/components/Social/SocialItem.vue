<template>
  <span>
    <transition name="slide-fade">
      <b-button v-bind:style="{
          'background': `url(${item.platform.iconPath})`,
          'background-size': 'cover',
          'background-repeat': 'no-repeat',
          'background-position': 'center',
          'border': 'none'}"
                v-show="isShow"
                class="social-button"
                :href="item.url"
                target="_blank"
                :variant="item.url !== null ? 'link' : ''"
                @click=" !item.url ? toggleShow($event) : '' ">
    </b-button>
    </transition>
    <transition name="slide-fade">
        <span class="social-item-span" v-show="!isShow"
              @click=" toggleShow($event)">
              {{ item.username }}
        </span>
      </transition>
  </span>
</template>

<script>
export default {
  name: 'SocialItem',
  props: {
    item: Object
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