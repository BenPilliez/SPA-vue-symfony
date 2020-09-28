<template>
  <b-container :fluid="true" class="rounded formEdit">

    <validation-observer ref="observer" v-slot="{ handleSubmit }">

      <b-form @submit.stop.prevent="handleSubmit(submit)">
        <b-row>
          <b-col cols="12">
            <h3>Plateformes de jeu</h3>
          </b-col>
        </b-row>
        <b-form-row class="mt-3">
          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="steam"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="steam-feedback"
                  id="steam-input"
                  v-model="form.steam"
                  placeholder="Pseudo steam"
              ></b-form-input>
              <b-form-invalid-feedback id="steam-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="origin"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="origin-feedback"
                  id="origin-input"
                  v-model="form.origin"
                  placeholder="Pseudo origin"
              ></b-form-input>
              <b-form-invalid-feedback id="origin-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-form-row>
        <b-form-row class="mt-3">

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="ubisoft"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="ubisoft-feedback"
                  id="ubisoft-input"
                  v-model="form.ubisoft"
                  placeholder="Pseudo ubisoft"
              ></b-form-input>
              <b-form-invalid-feedback id="ubisoft-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="battlenet"
                rules="max:255|url"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="battlenet-feedback"
                  id="battlenet-input"
                  v-model="form.battlenet"
                  placeholder="Url battlenet"
              ></b-form-input>
              <b-form-invalid-feedback id="battlenet-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-form-row>
        <b-form-row class="mt-3">

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="gog"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="gog-feedback"
                  id="gog-input"
                  v-model="form.gog"
                  placeholder="Pseudo gog"
              ></b-form-input>
              <b-form-invalid-feedback id="gog-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="lol"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="lol-feedback"
                  id="lol-input"
                  v-model="form.lol"
                  placeholder="Pseudo lol"
              ></b-form-input>
              <b-form-invalid-feedback id="lol-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-form-row>

        <b-form-row class="mt-3">

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="nintendo"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="nintendo-feedback"
                  id="nintendo-input"
                  v-model="form.nintendo"
                  placeholder="Pseudo nintendo"
              ></b-form-input>
              <b-form-invalid-feedback id="nintendo-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="psn"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="psn-feedback"
                  id="psn-input"
                  v-model="form.psn"
                  placeholder="Pseudo psn"
              ></b-form-input>
              <b-form-invalid-feedback id="psn-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-form-row>
        <b-form-row class="mt-3">

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="rockstar"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="rockstar-feedback"
                  id="rockstar-input"
                  v-model="form.rockstar"
                  placeholder="Pseudo rockstar"
              ></b-form-input>
              <b-form-invalid-feedback id="rockstar-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="wargaming"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="wargaming-feedback"
                  id="wargaming-input"
                  v-model="form.wargaming"
                  placeholder="Pseudo wargaming"
              ></b-form-input>
              <b-form-invalid-feedback id="wargaming-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-form-row>
        <b-form-row class="mt-3">
          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="xbox"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="xbox-feedback"
                  id="xbox-input"
                  v-model="form.xbox"
                  placeholder="Pseudo xbox"
              ></b-form-input>
              <b-form-invalid-feedback id="xbox-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-form-row>
        <b-row class="mt-5">
          <b-col cols="12">
            <h3>Réseaux sociaux</h3>
          </b-col>
        </b-row>
        <b-form-row>
          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="instagram"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="instagram-feedback"
                  id="instagram-input"
                  v-model="form.instagram"
                  placeholder="Pseudo instagram"
              ></b-form-input>
              <b-form-invalid-feedback id="instagram-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="snapchat"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="snapchat-feedback"
                  id="snapchat-input"
                  v-model="form.snapchat"
                  placeholder="Pseudo snapchat"
              ></b-form-input>
              <b-form-invalid-feedback id="snapchat-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-form-row>

        <b-form-row class="mt-3">
          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="facebook"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="facebook-feedback"
                  id="facebook-input"
                  v-model="form.facebook"
                  placeholder="Pseudo facebook"
              ></b-form-input>
              <b-form-invalid-feedback id="facebook-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="twitter"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="twitter-feedback"
                  id="twitter-input"
                  v-model="form.twitter"
                  placeholder="Pseudo twitter"
              ></b-form-input>
              <b-form-invalid-feedback id="twitter-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-form-row>

        <b-form-row class="mt-3">
          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="youtube"
                rules="max:255|url"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="youtube-feedback"
                  id="youtube-input"
                  v-model="form.youtube"
                  placeholder="Lient de ta chaine"
              ></b-form-input>
              <b-form-invalid-feedback id="youtube-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>

          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="twitch"
                rules="max:255|url"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="twitch-feedback"
                  id="twitch-input"
                  v-model="form.twitch"
                  placeholder="pseudo twitch"
              ></b-form-input>
              <b-form-invalid-feedback id="twitch-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-form-row>

        <b-form-row class="mt-3">
          <b-col cols="12" lg="6" md="6" sm="6">
            <validation-provider
                name="skype"
                rules="max:255"
                v-slot="validationContext"
            >
              <b-form-input
                  :state="getValidationState(validationContext)"
                  aria-describedby="skype-feedback"
                  id="skype-input"
                  v-model="form.skype"
                  placeholder="Pseudo skype"
              ></b-form-input>
              <b-form-invalid-feedback id="skype-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
          </b-col>
        </b-form-row>

        <b-form-row class="mt-5">
          <b-col cols="12">
            <b-button size="lg" class="w-100" type="submit" variant="success">Mettre à jour</b-button>
          </b-col>
        </b-form-row>
      </b-form>
    </validation-observer>
  </b-container>
</template>

<script>

import {EventBus} from "../../../helpers/event-bus";

export default {
  name: "SocialForm",
  props: {
    social: Object,
  },
  data() {
    return {
      form: {
        steam: this.social !== null ? this.social.steam : '',
        origin: this.social !== null ? this.social.origin : '',
        ubisoft: this.social !== null ? this.social.ubisoft : '',
        battlenet: this.social !== null ? this.social.battlenet : '',
        facebook: this.social !== null ? this.social.facebook : '',
        gog: this.social !== null ? this.social.gog : '',
        instagram: this.social !== null ? this.social.instagram : '',
        lol: this.social !== null ? this.social.lol : '',
        nintendo: this.social !== null ? this.social.nintendo : '',
        psn: this.social !== null ? this.social.psn : '',
        rockstar: this.social !== null ? this.social.rockstar : '',
        skype: this.social !== null ? this.social.skype : '',
        snapchat: this.social !== null ? this.social.snapchat : '',
        twitch: this.social !== null ? this.social.twitch : '',
        twitter: this.social !== null ? this.social.twitter : '',
        wargaming: this.social !== null ? this.social.wargaming : '',
        xbox: this.social !== null ? this.social.xbox : '',
        youtube: this.social !== null ? this.social.youtube : '',
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

        let user = this.$store.getters.users[this.$route.params.id];

        this.form.url = '/api/user_platforms'
        this.form.method = "POST"
        this.form.user = user['@id'];
        if (this.social !== null) {
          this.form.method = "PUT";
          this.form.url = `/api/user_platforms/${this.social.id}`
        }

        this.$store.dispatch('platform', this.form).then((resp) => {
          user.userPlatform = resp.data;
          EventBus.$emit('userUpdated', user);
        })
      }
    }
  }
}
</script>

<style>

</style>