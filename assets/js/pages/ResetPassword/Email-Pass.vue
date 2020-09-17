<template>
  <b-container :fluid=true>
    <section class="customForm ">
      <b-row class="w-100 justify-content-center align-items-center">
        <div class="d-flex justify-content-between  bg-white container-reset">
          <b-col lg="6" md="6" class="d-none d-lg-block d-md-block">
            <b-img :src="'/images/password-img.png'"/>
          </b-col>

          <b-col cols="12" md="6" lg="6">
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
              <form @submit.stop.prevent="handleSubmit(submit)">

                <b-form-row>
                  <b-col cols="12">
                    <span class="form-title">Réinitialisation mot de passe</span>
                  </b-col>

                  <b-col cols="12">
                    <validation-provider
                        name="email"
                        rules="required|email"
                        v-slot="validationContext"
                    >

                      <b-form-group
                          description="Entre ton adresse email et nous t'enverrons un lien pour réinitialiser ton
                          mot de passe "
                      >
                        <b-input-group>
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
                      </b-form-group>
                    </validation-provider>

                  </b-col>
                  <b-col cols="12">
                    <b-button variant="success" type="submit">Demande de réinitialisation</b-button>
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
  name: "EmailPass",
  data(){
    return{
      form:{
        email: ''
      }
    }
  },
  methods: {
    async submit() {

      let isValid = await this.$refs.observer.validate();

      if(isValid){
        this.$store.dispatch('reset_password', this.form);
      }

    },
    getValidationState({dirty, validated, valid = null}) {
      return dirty || validated ? valid : null;
    },
  }
}
</script>

<style scoped>

</style>