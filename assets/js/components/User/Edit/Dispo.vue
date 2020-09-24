<template>

  <b-container :fluid="true" class="rounded formEdit">
    <b-form @submit.stop.prevent="submit">
      <b-row>
        <b-col cols="12">
          <div class="p5" v-for="(value) in dispo">
            <b-row class="mt-4">
              <b-col cols="3">
                {{ value.day}}
              </b-col>
              <b-col cols="9">
                <b-form-checkbox
                    :id="value['@id']"
                    :name="value['@id']"
                    :value="{'lundi':{'morning':true}}"
                    :checked="value.morning === true"
                    unchecked-value="false"
                >
                  <b-img width="32" height="32" src="/images/dispo/morning.svg" class="sprite"></b-img>
                </b-form-checkbox>
                <!--<div class="custom-control custom-checkbox">
                  <input type="checkbox" id="ossm" name="ossm">
                  <label for="ossm">CSS is Awesome</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                  <label class="custom-control-label" for="customCheck"><b-img width="32" height="32" src="/images/dispo/morning.svg" class="sprite"></b-img></label>
                </div>
                <label>
                  <input type="checkbox" value="1"
                              checked="checked">
                  <b-img width="32" height="32" src="/images/dispo/morning.svg" class="sprite"></b-img>
                </label>

                <label><input type="checkbox" value="1"
                              :checked="value.midday === true">
                  <b-img width="32" height="32" src="/images/dispo/midday.svg" class="sprite"></b-img>
                </label>

                <label><input type="checkbox" value="1"
                              :checked="value.evening === true">
                  <b-img width="32" height="32" src="/images/dispo/evening.svg" class="sprite"></b-img>
                </label>

                <label><input type="checkbox" value="1"
                              :checked="value.night === true">
                  <b-img width="32" height="32" src="/images/dispo/night.svg" class="sprite"></b-img>
                </label>-->
              </b-col>
            </b-row>
          </div>
        </b-col>
      </b-row>
      <b-row class="mt-4">
        <b-col cols="12">
          <b-button size="lg" class="w-100" type="submit" variant="success">Mettre à jour</b-button>
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
  methods: {
    submit() {
      console.log()
    }
  },
  beforeMount() {
    console.log(this.dispo)
  }
}
</script>

<style></style>