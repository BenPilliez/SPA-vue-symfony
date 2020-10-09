<template>
  <div>
    <b-card v-if="horizontal === false"
            footer-tag="footer"
            tag="article"
            style="min-height: 25rem;max-width: 20rem;"
            class="mb-2"
    >
      <b-card-img :src="src"
                  img-alt="photo"
                  img-top
      />
      <b-card-body>
        <b-card-title>
          {{ title }}
        </b-card-title>

        <b-card-text>
          <slot name="content"></slot>
        </b-card-text>
      </b-card-body>

      <template v-slot:footer>
        <slot name="button"></slot>
      </template>
    </b-card>

    <b-card v-if="horizontal === true" no-body class="overflow-hidden" >
      <b-row no-gutters>
        <b-col md="6">
          <b-card-img :src="src"
                      img-alt="photo"
                      class="rounded-0"
          />
        </b-col>
        <b-col md="6">
          <b-card-body>
            <b-card-title>
              {{ title }}
            </b-card-title>

            <b-card-text>
              <slot name="content"></slot>
            </b-card-text>
          </b-card-body>
        </b-col>
      </b-row>
      <template v-slot:footer>
        <slot name="button"></slot>
      </template>
    </b-card>
  </div>
</template>

<script>
export default {
  name: "cardList.vue",
  props: {
    title: String,
    src: String,
    horizontal: {
      default: false,
      type: Boolean
    },

  }
}
</script>

<style scoped>

</style>