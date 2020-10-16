<template>
  <div>
    <b-card no-body img-top img-src="/images/jumbotron.jpg" style="min-height:400px ;">
      <b-row class="justify-content-center">
        <b-col lg="3">
          <div class="card-profile-image">
            <router-link :to="link">
              <b-img :src="src" rounded="circle"></b-img>
            </router-link>
          </div>
        </b-col>
      </b-row>

      <b-card-header class="text-center border-0 pt-3 pt-md-4 pb-0 pb-md-4">
        <div class="d-flex justify-content-between">
          <b-button variant="info" size="sm" class="mr-4"> <b-icon-person-plus></b-icon-person-plus> </b-button>
          <b-button  size="sm" class="float-right"> <b-icon-chat-left-dots></b-icon-chat-left-dots> </b-button>
        </div>
      </b-card-header>

      <b-card-body class="pt-0">
        <b-row>
          <b-col>
            <div class="card-profile-info d-flex justify-content-between">
                <div v-if="item.gamerType" class="pr-1">
                  <span class="heading">{{ item.gamerType }}</span>
                </div>
                <div v-if="item.country">
                  <span class="heading"> {{ item.country }}</span>
                </div>
              </div>
          </b-col>
        </b-row>
        <div class="text-center">
          <h5 class="h3">
            {{item.username}}<span class="font-weight-light" v-if="item.age">, {{item.age}}</span>
          </h5>
          <div class="h5 font-weight-300">
            {{ item.gameRegion }}
          </div>
        </div>
      </b-card-body>
    </b-card>
  </div>
</template>

<script>
export default {
  name: "cardMember",
  props: {
    src: String,
    link: Object,
    item: Object,
  }
}
</script>

<style scoped>

.card-header{
  background: transparent;
}

.card-profile-image img {
  position: absolute;
  left: 50%;
  height: 120px;
  max-width: 120px;
  transition: all .15s ease;
  transform: translate(-50%, -50%) scale(1);
  border-radius: .375rem;
}

.card-profile-info {
  padding: 1rem 0;
}

.card-profile-stats>div .description {
  font-size: .875rem;
  color: #adb5bd;
}

.card-profile-stats>div .heading {
  font-size: 1.1rem;
  font-weight: 700;
  display: block;
}
.h3{
  font-size: 1.0625rem;
  font-family: inherit;
  font-weight: 600;
  line-height: 1.5;
  margin-bottom: .5rem;
  color: #32325d;
}

.font-weight-300 {
  font-weight: 300!important;
}

.h5, h5 {
  font-size: .8125rem;
  font-family: inherit;
  font-weight: 600;
  line-height: 1.5;
  margin-bottom: .5rem;
  color: #32325d;
}
</style>