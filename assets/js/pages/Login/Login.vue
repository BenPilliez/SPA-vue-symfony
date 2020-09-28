<template>
  <section class="customForm">
    <b-container fluid>
      <b-row class="w-100 justify-content-center align-items-center">
        <div class="d-flex justify-content-between  bg-white container-login">
          <b-col lg="6" md="6" class="d-none d-lg-block d-md-block">
            <b-img :src="'/images/login-user.png'"></b-img>
          </b-col>

          <b-col cols="12" lg="6" md="6">
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
              <b-form @submit.stop.prevent="handleSubmit(submit)" class="form-login" method="post">

                <span class="form-title">Se connecter</span>

                <validation-provider
                    name="username"
                    rules="required"
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

                <validation-provider
                    name="password"
                    rules="required"
                    v-slot="validationContext"
                >
                  <b-input-group class="mt-3">
                    <template v-slot:prepend>
                      <b-input-group-text>
                        <b-icon-key>
                        </b-icon-key>
                      </b-input-group-text>
                    </template>
                    <b-form-input
                        type="password"
                        :state="getValidationState(validationContext)"
                        aria-describedby="password-feedback"
                        id="password-input"
                        v-model="form.password"
                        placeholder="Password">
                    </b-form-input>
                    <b-form-invalid-feedback id="password-feedback">{{
                        validationContext.errors[0]
                      }}
                    </b-form-invalid-feedback>
                  </b-input-group>
                </validation-provider>
                <b-col cols="12" class="mt-4">
                  <b-button variant="success" type="submit">Se connecter</b-button>
                </b-col>

                <b-col cols="12" class="mt-8">
                  <div class="text-center pt-3">
                    <router-link
                        :to="{name:'reset_form'}"
                    >
                      Mot de passe oublié ?
                    </router-link>
                  </div>
                  <div class="text-center pt-4">
                    <router-link
                        :to="{name:'register'}"
                    >
                      Créer ton compte
                      <i class="fas fa-long-arrow-alt-right"></i>
                    </router-link>
                  </div>
                </b-col>
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
  name: "Login",
  data() {
    return {
      form: {
        username: '',
        password: '',
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
        let user = this.form;
        this.$store.dispatch('login', user)
        .then((resp) => {
          this.$router.push('/');
        })
      }
    }
  }
}

</script>


<style></style>