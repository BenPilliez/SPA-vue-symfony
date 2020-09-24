<template>
  <b-container fluid class="formEdit">
    <validation-observer ref="observer" v-slot="{ handleSubmit }">
      <b-form @submit.stop.prevent="handleSubmit(onSubmit)" methods="POST">
        <b-row>
          <b-col cols="12" class="d-flex justify-content-center">
            <b-img v-if="url"
                   :src="url"
                   width="300"
                   height="300"
            ></b-img>
          </b-col>
          <b-col cols="12" class="mt-4">
            <validation-provider
                name="file"
                rules="required|image|ext:jpg,png"
                v-slot="validationContext"
            >
              <b-form-file
                  v-model="file"
                  :state="getValidationState(validationContext)"
                  accept=".jpg, .png"
                  placeholder="Choose a file or drop it here..."
                  drop-placeholder="Drop file here..."
                  aria-describedby="file-feedback"

              ></b-form-file>
              <b-form-invalid-feedback id="file-feedback">{{
                  validationContext.errors[0]
                }}
              </b-form-invalid-feedback>
            </validation-provider>
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
import {EventBus} from '../../../helpers/event-bus';

export default {
  name: "AvatarForm",
  props: ['avatar'],
  data() {
    return {
      file: null,
      url: null
    }
  },
  methods: {

    getValidationState({dirty, validated, valid = null}) {
      return dirty || validated ? valid : null;
    },
    async onSubmit() {

      let formData = new FormData();
      formData.append('file', this.file);
      let user = this.$store.getters.users[this.$route.params.id];
      let isValid = await this.$refs.observer.validate()

      let url = null;
      if (user.mediaObjects[0]) {
        url = `/api/media_objects/${user.mediaObjects[0].id}`
      }

      formData.append('user', user.id);

      if (isValid) {
        this.$store.dispatch('upload', {formData, url}).then((resp) => {
          user.isOwner = true;
          user.edit = true;
          user.mediaObjects[0] = resp.data;
          this.$store.commit('users', user);
          this.$store.commit('auth_user', user)
          localStorage.setItem('auth_user', JSON.stringify(user))
          EventBus.$emit('userUpdated', user);
        })
      }
    }
  }
}

</script>