<template>
  <b-container :fluid="true" class="formEdit rounded">
    <validation-observer ref="observer" v-slot="{ handleSubmit }">
      <b-form @submit.stop.prevent="handleSubmit(onSubmit)" methods="PUT">
        <b-row>
          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3">
            <validation-provider
                name="Processor"
                rules="regex:^^[a-zA-Z0-9\s]+$"
                v-slot="validationContext"
            >
              <b-form-group
                  id="processor"
                  label="CPU"
                  label-for="processor-input"
              >
                <b-input id="processor-input" v-model="form.cpu"
                         :state="getValidationState(validationContext)"
                         aria-describedby="processor-feedback"
                         placeholder="CPU"></b-input>
                <b-form-invalid-feedback id="processor-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>

              </b-form-group>
            </validation-provider>
          </b-col>
          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3">
            <validation-provider
                name="MotherBoard"
                rules="regex:^^[a-zA-Z0-9\s]+$"
                v-slot="validationContext"
            >
              <b-form-group
                  id="motherboard"
                  label="Carte mère "
                  label-for="motherboard-input"
              >
                <b-input id="motherboard-input"
                         :state="getValidationState(validationContext)"
                         aria-describedby="cm-feedback"
                         v-model="form.motherboard"
                         placeholder="Carte mère"></b-input>
                <b-form-invalid-feedback id="cm-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>
          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3">
            <validation-provider
                name="Graphic Card"
                rules="regex:^^[a-zA-Z0-9\s]+$"
                v-slot="validationContext"
            >
              <b-form-group
                  id="graphicCard"
                  label="Carte graphique"
                  label-for="graphic-card-input"
              >
                <b-input id="graphic-card-input"
                         :state="getValidationState(validationContext)"
                         aria-describedby="cg-feedback"
                         v-model="form.graphicCard"
                         placeholder="Carte graphique"></b-input>
                <b-form-invalid-feedback id="cg-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>
          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3">
            <validation-provider
                name="Power"
                rules="regex:^^[a-zA-Z0-9\s]+$"
                v-slot="validationContext"
            >
              <b-form-group
                  id="power"
                  label="Alimentation"
                  label-for="power-input"
              >
                <b-input id="power-input"
                         :state="getValidationState(validationContext)"
                         aria-describedby="power-feedback"
                         v-model="form.power"
                         placeholder="Alimentation"></b-input>

                <b-form-invalid-feedback id="power-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>
          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3">
            <validation-provider
                name="RAM"
                rules="regex:^^[a-zA-Z0-9\s]+$"
                v-slot="validationContext"
            >
              <b-form-group
                  id="ram"
                  label="RAM "
                  label-for="ram-input"
              >
                <b-input id="ram-input"
                         :state="getValidationState(validationContext)"
                         aria-describedby="ram-feedback"
                         v-model="form.ram"
                         placeholder="RAM"></b-input>
                <b-form-invalid-feedback id="ram-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>
          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3">
            <validation-provider
                name="Cooler"
                rules="regex:^^[a-zA-Z0-9\s]+$"
                v-slot="validationContext"
            >
              <b-form-group
                  id="cooler"
                  label="Ventilation"
                  label-for="cooler-input"
              >
                <b-input id="cooler-input"
                         :state="getValidationState(validationContext)"
                         aria-describedby="cooler-feedback"
                         v-model="form.cooler"
                         placeholder="Ventilation"></b-input>
                <b-form-invalid-feedback id="cooler-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>

          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3">
            <validation-provider
                name="Screen"
                rules="regex:^^[a-zA-Z0-9\s]+$"
                v-slot="validationContext"
            >
              <b-form-group
                  id="screen"
                  label="Ecran"
                  label-for="screen-input"
              >
                <b-input id="screen-input"
                         :state="getValidationState(validationContext)"
                         aria-describedby="screen-feedback"
                         v-model="form.screen"
                         placeholder="Ecran"></b-input>
                <b-form-invalid-feedback id="screen-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>
          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3">
            <validation-provider
                name="Keyboard"
                rules="regex:^^[a-zA-Z0-9\s]+$"
                v-slot="validationContext"
            >
              <b-form-group
                  id="keyboard"
                  label="Clavier "
                  label-for="keyboard-input"
              >
                <b-input id="keyboard-input"
                         :state="getValidationState(validationContext)"
                         aria-describedby="keyboard-feedback"
                         v-model="form.keyboard"
                         placeholder="Clavier"></b-input>
                <b-form-invalid-feedback id="keyboard-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>
          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3">
            <validation-provider
                name="Mousepad"
                rules="regex:^^[a-zA-Z0-9\s]+$"
                v-slot="validationContext"
            >
              <b-form-group
                  id="mousepad"
                  label="Souris "
                  label-for="mousepad-input"
              >
                <b-input id="mousepad-input"
                         :state="getValidationState(validationContext)"
                         aria-describedby="mousepad-feedback"
                         v-model="form.mouse"
                         placeholder="Souris"></b-input>
                <b-form-invalid-feedback id="mousepad-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>
          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3 mb-3">
            <validation-provider
                name="Controller"
                rules="regex:^^[a-zA-Z0-9\s]+$"
                v-slot="validationContext"
            >
              <b-form-group
                  id="controller"
                  label="Manette "
                  label-for="controller-input"
              >
                <b-input id="controller-input"
                         :state="getValidationState(validationContext)"
                         aria-describedby="controller-feedback"
                         v-model="form.controller"
                         placeholder="Manette"></b-input>
                <b-form-invalid-feedback id="controller-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>
          </b-col>
          <b-col cols="12" lg="6" md="6" sm="6" class="mt-3 mb-3">
            <b-form-group
                id="console"
                label="Consoles"
                label-for="console-input"
            >
              <v-select id="console-input" class="form-control" :multiple=true
                        :reduce="consoleType => consoleType.value"
                        v-model="form.consoles"
                        :placeholder="'Tes consoles'"
                        :options="consoleType"></v-select>
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="12" class="mt-4 mb-4">
            <b-button size="lg" class="w-100" type="submit" variant="success">Mettre à jour</b-button>
          </b-col>
        </b-row>
      </b-form>
    </validation-observer>
  </b-container>

</template>

<script>

import {EventBus} from "../../../helpers/event-bus";

export default {
  name: "formConfig",
  props: {config: Object},
  data() {
    return {
      form: {
        cpu: this.config ? this.config.cpu : '',
        motherboard: this.config ? this.config.motherboard : '',
        graphicCard: this.config ? this.config.graphicCard : '',
        power: this.config ? this.config.power : '',
        ram: this.config ? this.config.ram : '',
        cooler: this.config ? this.config.cooler : '',
        screen: this.config ? this.config.screen : '',
        keyboard: this.config ? this.config.keyboard : '',
        mouse: this.config ? this.config.mouse : '',
        controller: this.config ? this.config.controller : '',
        consoles: this.config ? this.config.consoles : []
      },
      consoleType: [
        {value: 'PS4', label: 'PS4'},
        {value: 'XBOX ONE', label: 'XBOX ONE'},
        {value: 'Switch', label: 'Switch'},
        {value: 'XBOX 360', label: 'XBOX 360'},
        {value: 'WII U', label: 'WII U'},
        {value: 'PS3', label: 'PS3'},
        {value: 'PSP', label: 'PSP'},
        {value: 'Nintendo DS', label: 'Nintendo DS'}
      ]
    }
  },
  methods: {
    getValidationState({dirty, validated, valid = null}) {
      return dirty || validated ? valid : null;
    },
    async onSubmit() {

      let form = this.form;
      let url = "/api/user_configs";
      form.type = "hardware";
      let user = this.$store.getters.users[this.$route.params.id];

      form.method = "POST";
      form.user = user['@id'];

      if (this.config !== null) {
        form.method = "PUT";
        url = `/api/user_configs/${this.config.id}`;
      }

      let isValid = await this.$refs.observer.validate();

      if (isValid) {
        this.$store.dispatch('send', {form, url})
            .then((resp) => {
              resp.data.isOwner = true;
              resp.data.edit = true;
              user.userConfig = resp.data;
              this.$store.commit('users', user);
              localStorage.setItem('auth_user', JSON.stringify(user));
              EventBus.$emit('userUpdated', this.$store.getters.users[this.$route.params.id]);
            })
      }
    }
  }
}

</script>

<style></style>