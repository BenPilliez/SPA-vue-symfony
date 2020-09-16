<template>
  <section class="customForm">
    <b-container fluid>
      <b-row class="w-100 justify-content-center align-items-center">
        <div class="d-flex justify-content-between  bg-white container-register">
          <b-col lg="6" md="6" class="d-none d-lg-block d-md-block">
            <b-img :src="'/images/login-user.png'"></b-img>
          </b-col>

          <b-col cols="12" lg="6" md="6">
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
              <b-form @submit.stop.prevent="handleSubmit(submit)" class="form-register" method="post">

                <span class="form-title">Créer ton compte</span>
                <b-form-row>
                  <b-col cols="12">
                    <b-form-group
                        description="Ton pseudo doit faire 4-20 caractères de longueur max,il ne
                    peut contentir d'émojies, d'espaces ou de cartères spéciaux"
                    >

                      <validation-provider
                          name="username"
                          rules="required|min:4|max:20|regex:^[a-zA-Z0-9]*$"
                          v-slot="validationContext"
                      >
                        <b-input-group class="mt-3">
                          <template v-slot:prepend>
                            <b-input-group-text>
                              <b-icon-person-fill>
                              </b-icon-person-fill>
                            </b-input-group-text>
                          </template>
                          <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="username-feedback"
                              id="username-input"
                              v-model="form.username"
                              placeholder="Pseudonyme">
                          </b-form-input>
                          <b-form-invalid-feedback id="username-feedback">{{
                              validationContext.errors[0]
                            }}
                          </b-form-invalid-feedback>
                        </b-input-group>
                      </validation-provider>
                    </b-form-group>
                  </b-col>

                  <b-col cols="12">
                    <b-form-group
                    >
                      <validation-provider
                          name="email"
                          rules="required|email"
                          v-slot="validationContext"
                      >
                        <b-input-group class="mt-3">
                          <template v-slot:prepend>
                            <b-input-group-text>
                              <b-icon-envelope>
                              </b-icon-envelope>
                            </b-input-group-text>
                          </template>
                          <b-form-input
                              :state="getValidationState(validationContext)"
                              aria-describedby="email-feedback"
                              id="email-input"
                              v-model="form.email"
                              placeholder="Email">
                          </b-form-input>
                          <b-form-invalid-feedback id="email-feedback">{{
                              validationContext.errors[0]
                            }}
                          </b-form-invalid-feedback>
                        </b-input-group>
                      </validation-provider>
                    </b-form-group>
                  </b-col>
                  <b-col cols="12">
                    <validation-observer>
                      <validation-provider
                          name="password"
                          rules="required|confirmed:confirmation|min:8|max:20|regex:^(?=.*\d)(?=.*[A-Z])(?=.*[@#$%])(?!.*(.)\1{2}).*[a-z]"
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
                              id="password-input"
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

                  <b-col cols="12" class="mt-3">
                    <b-button variant="success" type="submit"> S'enregister</b-button>
                  </b-col>
                </b-form-row>
              </b-form>
            </validation-observer>
          </b-col>
        </div>
      </b-row>
    </b-container>
  </section>
</template>

<script>

export default {
  name: "Register",
  data() {
    return {
      form: {
        username: '',
        email: '',
        confirm_password: '',
        password: '',
      }
    }
  },
  methods: {
    getValidationState({dirty, validated, valid = null}) {
      return dirty || validated ? valid : null;
    },

    async submit (){
      let isValid = await this.$refs.observer.validate();

      if (isValid) {
        let user = this.form;
        this.$store.dispatch('register', user).then(() => {
          this.$router.push('/login');
        })
      }
    }

  }
}

</script>


<style></style>