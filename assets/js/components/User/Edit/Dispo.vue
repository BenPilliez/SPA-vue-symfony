<template>

  <b-container fluid="true" class="rounded formEdit">
    <b-form @submit.stop.prevent="handleSubmit(onSubmit)">
      <b-row>
        <b-col cols="12">
          <div class="p5" v-for="(value) in dispo">
            <b-row class="mt-4">
              <b-col cols="3">
                {{ value.day }}
              </b-col>
              <b-col cols="9" style="display:inline-block">
              <b-form-checkbox-group
                  class="customCheck1"
                  buttons
                  :options="lundi"
                  v-customcheckbox="lundi"
              >
               <!-- <b-form-checkbox
                    :id="value.day + 'morning   '"
                    name="morning"
                    value="true"
                    unchecked-value="false"
                    :checked="value.morning === true"
                    v-customcheckbox="{imageSrc:'/images/dispo/morning.svg', class:value.morning === true ? 'opacity-5 mr-3 ' : 'opacity-1 mr-3'}"
                >
                </b-form-checkbox>

                <b-form-checkbox
                    :id="value.day + 'midday'"
                    name="midday"
                    value="true"
                    unchecked-value="false"
                    :checked="value.midday === true"
                    v-customcheckbox="{imageSrc:'/images/dispo/midday.svg', class:value.midday === true ? 'opacity-5 mr-3 ' : 'opacity-1 mr-3'}"
                >
                </b-form-checkbox>-->
              </b-form-checkbox-group>


                <!--
                <b-img width="32" height="32" src="/images/dispo/midday.svg"
                       :class="value.midday === true ? 'opacity-5 mr-3 ' : 'opacity-1 mr-3'"></b-img>
                <b-img width="32" height="32" src="/images/dispo/evening.svg"
                       :class="value.evening === true ? 'opacity-5 mr-3' : 'opacity-1 mr-3'"></b-img>
                <b-img width="32" height="32" src="/images/dispo/night.svg"
                       :class="value.night === true ? 'opacity-5 mr-3' : 'opacity-1 mr-3'"></b-img>-->
              </b-col>
            </b-row>
          </div>
        </b-col>
      </b-row>
    </b-form>

  </b-container>
</template>

<script>
export default {
  name: "formDispo",
  props: {
    dispo: Array
  },
  data(){
    return{
      lundi:[
        {text:'morning', value: 'morning', imageSrc: '/images/dispo/evening.svg', checked: this.dispo[0].morning},
        {text:'midday', value: 'midday', imageSrc: '/images/dispo/midday.svg'},
        {text:'evening', value: 'evening', imageSrc: '/images/dispo/evening.svg'},
        {text:'night', value: 'night', imageSrc: '/images/dispo/night.svg'}
      ]
    }
  },
  directives: {
    customcheckbox: {
      inserted: function (el, binding) {
        {
          binding.value.map((item, key) => {
            el.getElementsByTagName('label')[key].style = 'background-image:url("' + item.imageSrc + '") !important; background-repeat: no-repeat;  background-size: 70%; background-position: center;'
          })
        }
      }
    }
  }
}
</script>

<style></style>