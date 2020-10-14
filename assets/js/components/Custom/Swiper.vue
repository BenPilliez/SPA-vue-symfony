<template>
  <div class="carousel">
    <swiper
        ref="carousel"
        class="swiper"
        :options="options"
    >

      <div v-if="banner" class="swiper-slide " :key="item.id" v-for="item in items">
        <router-link :to="{name:'game', params:{id: item.id}}">
          <b-img width="300" height="450" :src="item.gameImage ? `/games/${item.gameImage.filePath}` : '' "></b-img>
        </router-link>
      </div>
      <swiper-slide v-if="!banner" v-for="item in items" :key="item.id">{{ item.text }}</swiper-slide>

      <div class="swiper-pagination" slot="pagination"></div>
      <div class="swiper-button-prev" slot="button-prev"></div>
      <div class="swiper-button-next" slot="button-next"></div>
    </swiper>
  </div>
</template>

<script>
import {Swiper, SwiperSlide} from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'

export default {
  name: 'C-Swiper',
  components: {Swiper, SwiperSlide},
  props: {
    items: Array,
    options: Object,
    banner: Boolean,
  }
}
</script>

<style lang="scss" scoped>
.carousel {
  width: 100%;
  height: 600px;
  padding-top: 50px;
  padding-bottom: 50px;
}

.swiper {
  height: auto;

  .swiper-pagination {
    position: relative;
    margin-top: 10px;

    /deep/ .swiper-pagination-bullet.swiper-pagination-bullet-active {
      background: white;
    }
  }

}
</style>