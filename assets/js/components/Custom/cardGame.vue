<template>
  <router-link :to="link">
    <b-card :img-src="src" img-height="200" img-width="140" img-left class="mb-2" style="min-width: 300px;">
      <b-card-text>
        <div>
          <span class="heading">{{ item.name }}</span>
        </div>

        <div>
          <b-form-rating
              v-if="item.rates"
              :value="item.rates ? item.rates.calculatedRate : null"
              readonly
              :inline="true"
              color="#ff8800"
              precision="1"
              required
              no-border
              size="sm"
          />
        </div>
      </b-card-text>
    </b-card>
  </router-link>
</template>

<script>
export default {
  name: "cardGame",
  props: {
    src: String,
    link: Object,
    item: Object,
  }
}
</script>

<style scoped>
.heading {
  font-size: 1.1rem;
  font-weight: 700;
  display: block;
}
</style>