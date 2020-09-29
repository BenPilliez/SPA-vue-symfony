<template>

  <b-container :fluid=true>
    <section class="customForm">

      <b-row class="w-100 justify-content-center align-items-center">
        <div class="d-flex justify-content-between  bg-white container-reset">
          <b-col lg="6" md="6" class="d-none d-lg-block d-md-block">
            <b-img :src="'/images/password-img.png'"/>
          </b-col>

          <b-col cols="12" md="6" lg="6">
            <validation-observer ref="observer"  v-slot="{ handleSubmit }">
              <form @submit.stop.prevent="handleSubmit(submit)">
                <b-form-row>
                  <b-col cols="12">
                    <span class="form-title">Réinitialisation mot de passe</span>
                  </b-col>
                  <b-col cols="12">
                    <validation-observer>
                      <validation-provider
                          name="password"
                          :rules="{ required: true,confirmed:'confirmation',min:8, max:20, regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\?<>\{\}\[\]\(\)\$%\^&\*])(?=.{8,})/ }"
                          v-slot="validationContext"
                      >
                        <b-form-group
                            description="Ton mot de passe doit comprendre 4 caractères minimum et 2O max, il doit contenir
                    des lettres, au moins un chiffre et un caractère spécial, mais ni d'espace ou d'émojies"
                        >
                          <b-input-group class="mt-3">
                            <template v-slot:prepend>
                              <b-input-group-text>
                                <b-icon-key>
                                </b-icon-key>
                              </b-input-group-text>
                            </template>
                            <b-form-input
                                :state="getValidationState(validationContext)"
                                aria-describedby="password-feedback"
                                id="password-input"
                                type="password"
                                v-model="form.password"
                                placeholder="Mot de passe">
                            </b-form-input>
                            <b-form-invalid-feedback id="password-feedback">{{
                                validationContext.errors[0]
                              }}
                            </b-form-invalid-feedback>
                          </b-input-group>
                        </b-form-group>
                      </validation-provider>
                      <validation-provider
                          vid="confirmation"
                          v-slot="validationContext"
                          name="confirmation"
                      >

                        <b-input-group class="mt-3">
                          <template v-slot:prepend>
                            <b-input-group-text>
                              <b-icon-key>
                              </b-icon-key>
                            </b-input-group-text>
                          </template>
                          <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="confirm-feedback"
                              id="password-confirm-input"
                              type="password"
                              v-model="form.confirm_password"
                              placeholder="Confirmation mot de passe">
                          </b-form-input>
                          <b-form-invalid-feedback id="confirm-feedback">{{
                              validationContext.errors[0]
                            }}
                          </b-form-invalid-feedback>
                        </b-input-group>
                      </validation-provider>
                    </validation-observer>
                  </b-col>
                  <b-col cols="12">
                    <b-button variant="success" type="submit">Réinitialiser</b-button>
                  </b-col>
                </b-form-row>
              </form>
            </validation-observer>
          </b-col>
        </div>
      </b-row>

    </section>
  </b-container>


</template>

<script>
export default {
  name: "Reset",
  data() {
    return {
      form: {
        password: '',
        confirm_password: ''
      }
    }
  },
  methods: {
    getValidationState({dirty, validated, valid = null}) {
      return dirty || validated ? valid : null;
    },

    async submit() {
      let isValid = await this.$refs.observer.validate();

      if (isValid) {
        let form = this.form;
        form.token = this.$route.query.token;
        this.$store.dispatch('reset', form).then(() => {
          this.$router.push('/login');
        })
      } else {
        this.$store.commit('message', {type: 'error', text: 'Le formulaire contient des erreurs'})
      }
    }

  }
}
</script>

<style scoped>

</style>