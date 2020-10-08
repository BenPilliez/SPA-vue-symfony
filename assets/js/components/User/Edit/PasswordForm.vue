<template>
  <b-container class="formEdit rounded" fluid>
    <validation-observer ref="observer" slim tag="form" v-slot="{ handleSubmit }">
      <b-form @submit.stop.prevent="handleSubmit(onSubmit)" methods="PUT" class=" rounded bg-white">
        <b-row>
          <b-col cols="12">
            <validation-provider
                name="ancien mot de passe"
                rules="required"
                v-slot="validationContext">
              <b-input type="password"
                       :state="getValidationState(validationContext)"
                       aria-describedby="old-password-feedback"
                       name="old-password"
                       v-model="form.old_password"
                       placeholder="Ancien mot de passe"
              />
              <b-form-invalid-feedback id="old-password-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
          <b-col cols="12" class="mt-3">
            <validation-observer>
              <validation-provider
                  name="Nouveau mot de passe"
                  :rules="{ required: true,confirmed:'confirmation',min:8, max:20, regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\?<>\{\}\[\]\(\)\$%\^&\*])(?=.{8,})/ }"
                  v-slot="validationContext"
              >
                <b-input type="password"
                         :state="getValidationState(validationContext)"
                         aria-describedby="new-password-feedback"
                         name="new-password"
                         v-model="form.password"
                         placeholder="Nouveau password"
                >
                </b-input>
                <small class="form-text text-muted" id="new-password-feedback">
                  Ton mot de passe doit comprendre 4 caractères minimum et 2O max, il doit contenir
                  des lettres, au moins un chiffre et un caractère spécial, mais ni d'espace ou d'émojies
                </small>

                <b-form-invalid-feedback id="new-password-feedback">{{
                    validationContext.errors[0]
                  }}
                </b-form-invalid-feedback>
              </validation-provider>

              <validation-provider
                  vid="confirmation"
                  v-slot="validationContext"
                  name="confirmation"
              >
                <b-input type="password"
                         :state="getValidationState(validationContext)"
                         aria-describedby="confirmation-password-feedback"
                         name="confirmation password"
                         v-model="form.confirmation"
                         placeholder="Confirme ton mot de passe"
                >
                </b-input>
                <b-form-invalid-feedback id="confirmation-password-feedback">{{
                    validationContext.errors
                  }}
                </b-form-invalid-feedback>
              </validation-provider>
            </validation-observer>
          </b-col>
        </b-row>
        <b-row>
          <b-col cols="12" class="mt-3">
            <b-button size="lg" class="w-100" type="submit" variant="success">Update</b-button>
          </b-col>
        </b-row>
      </b-form>
    </validation-observer>
  </b-container>
</template>

<script>

export default {
  name: "PasswordForm",
  data() {
    return {
      form: {
        password: '',
        confirmation: '',
        old_password: '',
      }
    }
  },
  methods: {
    getValidationState({dirty, validated, valid = null}) {
      return dirty || validated ? valid : null;
    },
    async onSubmit() {

      let isValid = await this.$refs.observer.validate();

      if (isValid) {
        this.form.id = this.$store.getters.users[this.$route.params.id].id;
        this.$store.dispatch('update_password', this.form)
      }
    }
  }
}
</script>

<style scoped>
form {
  min-height: 50vh;
  padding: 40px 40px;
}
</style>