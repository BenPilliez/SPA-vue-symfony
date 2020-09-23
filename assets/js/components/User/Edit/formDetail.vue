<template>
  <b-container :fluid="true" class="formEdit rounded">
    <validation-observer ref="observer" v-slot="{ handleSubmit }">
      <b-form @submit.stop.prevent="handleSubmit(onSubmit)" methods="PUT">
        <b-row>
          <b-col cols="12" lg="6" md="6" sm="6">
            <vue-editor v-model="form.description" :editor-toolbar="customToolbar"></vue-editor>
          </b-col>
          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="Gamer Type"
                v-slot="validationContext"
            >
              <b-form-group
                  id="gamertype"
                  label="Style de jeu"
                  label-for="gamer-type-input"
              >
                <b-input-group>
                  <template v-slot:prepend>
                    <b-input-group-text><i class="fas fa-gamepad"></i>
                    </b-input-group-text>
                  </template>
                  <v-select :reduce="gamerTypes => gamerTypes.value" class=" form-control"
                            v-model="form.gamerType "
                            :placeholder="'Style de jeu'"
                            id="gamer-type"
                            :state="getValidationState(validationContext)"
                            aria-describedby="gamertype-feedback"
                            :options="gamerTypes"></v-select>
                </b-input-group>
                <b-form-invalid-feedback id="gamertype-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <validation-provider
                name="country"
                v-slot="validationContext"
            >
              <b-form-group
                  id="Country"
                  label="D'où tu viens ?"
                  label-for="country-input"
              >
                <b-input-group>
                  <template v-slot:prepend>
                    <b-input-group-text><i class="fas fa-globe"></i></b-input-group-text>
                  </template>
                  <v-select class=" form-control" v-model="form.country" label="place_name"
                            placeholder="Select your country"
                            :filterable="false"
                            id="country-input"
                            :state="getValidationState(validationContext)"
                            aria-describedby="country-feedback"
                            :reduce="countries => countries.place_name" :options="countries"
                            @search="onSearch">
                    <template slot="no-options">
                      Type to search country
                    </template>
                    <template slot="option" slot-scope="option">
                      <div class="d-center">
                        {{ option.place_name }}
                      </div>
                    </template>
                  </v-select>
                </b-input-group>
                <b-form-invalid-feedback id="country-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <validation-provider
                name="other Language"
                v-slot="validationContext"
            >
              <b-form-group
                  id="other"
                  label="Tu parles quoi ?"
                  label-for="other-input"
              >
                <b-input-group>
                  <template v-slot:prepend>
                    <b-input-group-text><i class="fas fa-flag"></i></b-input-group-text>
                  </template>
                  <v-select class=" form-control" v-model="form.languages" :multiple=true
                            :placeholder="'Tu parles quoi ?'" :reduce="languages => languages.label"
                            id="languages-input"
                            :state="getValidationState(validationContext)"
                            aria-describedby="languages-feedback"
                            :options="languages"></v-select>
                </b-input-group>
                <b-form-invalid-feedback id="languages-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <validation-provider
                name="game region"
                v-slot="validationContext"
            >
              <b-form-group
                  id="game_region "
                  label="Région de jeu"
                  label-for="gamre_region-input"
              >
                <b-input-group>
                  <template v-slot:prepend>
                    <b-input-group-text><i class="fas fa-globe"></i></b-input-group-text>
                  </template>
                  <v-select :reduce="gameRegions => gameRegions.value" class=" form-control"
                            v-model="form.gameRegion"
                            :placeholder="'Select game Region'"
                            id="gamre_region-input"
                            :state="getValidationState(validationContext)"
                            aria-describedby="game-region-feedback"
                            :options="gameRegions"></v-select>
                </b-input-group>
                <b-form-invalid-feedback id="game-region-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="gender"
                v-slot="validationContext"
            >
              <b-form-group
                  id="gender"
                  label="Genre"
                  label-for="gender-input"
              >
                <b-input-group>
                  <template v-slot:prepend>
                    <b-input-group-text><i class="fas fa-venus-mars"></i></b-input-group-text>
                  </template>
                  <v-select class="form-control" :reduce="options => options.value" v-model="form.gender"
                            :placeholder="'Select gender'"
                            :state="getValidationState(validationContext)"
                            aria-describedby="gender-feedback"
                            id="gender-input"
                            :options="options"></v-select>
                </b-input-group>
                <b-form-invalid-feedback id="gender-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>

          <b-col cols="12" md="6" sm="6" lg="6">
            <validation-provider
                name="Date of Birth"
                v-slot="validationContext"
            >
              <b-form-group
                  id="birthday"
                  label="Date de naissance"
                  label-for="birthday-input"
              >
                <b-input-group class="mb-3">
                  <b-input-group-append>
                    <b-form-datepicker
                        v-model="form.birthday"
                        button-only
                        id="birthday"
                        left
                        dropleft
                        locale="en-US"
                        aria-controls="example-input"
                        @context="onContext"
                    ></b-form-datepicker>
                  </b-input-group-append>
                  <b-form-input
                      id="example-input"
                      v-model="form.birthday"
                      type="text"
                      placeholder="YYYY-MM-DD"
                      autocomplete="off"
                      :state="getValidationState(validationContext)"
                      aria-describedby="datebirth-feedback"
                      :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                  ></b-form-input>
                </b-input-group>
                <b-form-invalid-feedback id="datebirth-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>
        </b-row>
        <b-row class="mt-4">
          <b-col cols="12">
            <b-button size="lg" class="w-100" type="submit" variant="success">Mettre à jour</b-button>
          </b-col>
        </b-row>
      </b-form>
    </validation-observer>
  </b-container>
</template>

<script>

import {VueEditor} from "vue2-editor";
import {language} from "../../../helpers/language";
import {EventBus} from "../../../helpers/event-bus";


export default {
  name: "formDetail",
  components: {VueEditor},
  props: {
    user: Object
  },
  data() {
    return {
      form: {
        slogan: this.user.slogan,
        description: this.user.description,
        languages: this.user.languages,
        gender: this.user.gender,
        country: this.user.country,
        gameRegion: this.user.gameRegion,
        birthday: new Date(this.user.birthday).toLocaleDateString(),
        gamerType: this.user.gamerType,
      },
      customToolbar: [
        ["bold", "italic", "underline"],
        ["blockquote"],
        [
          {align: ""},
          {align: "center"},
          {align: "right"},
          {align: "justify"}
        ],
        [{color: []}]
      ],
      countries: [],
      gamerTypes: [
        {value: 'Casual', label: 'Casual'},
        {value: 'Regular', label: 'Regular'},
        {value: 'Challenger', label: 'Challenger'},
        {value: 'Hardcore', label: 'Hardcore'},
        {value: 'Achievement hunter', label: 'Achievement hunter'},
        {value: 'Competitive player ', label: 'Competitive player '},
      ],
      gameRegions: [
        {value: 'Asie', label: "Asie"},
        {value: 'Europe', label: 'Europe'},
        {value: 'Amérique', label: 'Amérique'}
      ],
      options: [
        {value: 'Homme', label: 'Homme'},
        {value: 'Femme', label: 'Femme'},
        {value: 'Autre', label: 'Autre'},
      ],
      languages: language,
      formatted: '',
      selected: '',
    }
  },
  methods: {
    onContext(ctx) {
      // The date formatted in the locale, or the `label-no-date-selected` string
      this.formatted = ctx.selectedFormatted
      // The following will be an empty string until a valid date is entered
      this.selected = ctx.selectedYMD
    },
    onSearch(search, loading) {
      loading(true)
      this.search(loading, search, this, 'countries');
    },
    getValidationState({dirty, validated, valid = null}) {
      return dirty || validated ? valid : null;
    },

    search: (loading, search, vm, option) => {
      if (search !== "") {
        vm.$store.dispatch('country', {search, option})
            .then(() => {
              vm[option] = vm.$store.getters.result;
            }).catch((err) => {
          console.error(err)
        })
      }
      loading(false)
    },

    async onSubmit() {

      let form = this.form;
      form.method = "PUT";
      let url = `/api/users/${this.$route.params.id}`;
      let isValid = await this.$refs.observer.validate();

      console.log(this.form)
      if(isValid){
        this.$store.dispatch('send', {form, url})
        .then((resp)=> {
          resp.data.isOwner = true;
          resp.data.edit = true;
          this.$store.commit('users', resp.data);
          EventBus.$emit('userUpdated', resp.data);
        })
      }
    }
  }
}

</script>

<style>

</style>