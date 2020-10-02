<template>
  <b-container fluid class="formEdit">
    <b-form @submit.stop.prevent="onSubmit" methods="POST">
      <b-row>
        <b-col cols="12">
          <Gallery v-model="selected" :items="itemsGallery"></Gallery>
        </b-col>

        <b-col cols="12" class="mt-4">
          <image-uploader
              ref="fileUpload"
              v-model="file"
              :preview="false"
              :className="['fileinput', { 'fileinput--loaded': hasImage }]"
              :debug="1"
              :maxWidth="192"
              :maxHeight="192"
              :quality="1"
              doNotResize="gif"
              :autoRotate="true"
              accept=".jpg, .png"
              outputFormat="file"
              :capture="true"
              aria-describedby="file-feedback"
              @input="setImage"
          >
            <label for="fileInput" slot="upload-label"
                   class="d-flex flex-column justify-content-center align-items-center">
              <i class="fas fa-camera fa-3x" id="upload-icon"></i>
              <span class="upload-caption">{{
                  hasImage ? `${image}` : "Charger l'image"
                }}</span>

            </label>
          </image-uploader>
        </b-col>
      </b-row>
      <b-row>
        <b-col cols="12" class="mt-3">
          <b-button size="lg" class="w-100" type="submit" variant="success">Mettre à jour</b-button>
        </b-col>
      </b-row>
    </b-form>
  </b-container>
</template>

<script>
import {EventBus} from '../../../helpers/event-bus';
import ImageUploader from 'vue-image-upload-resize'
import Gallery from "../../Custom/Gallery"

export default {
  name: "AvatarForm",
  props: ['avatar'],
  components: {ImageUploader, Gallery},
  data() {
    return {
      file: null,
      hasImage: false,
      image: '',
      selected: '',
      itemsGallery: [
        {
          name: 'girl-1.jpg',
          filePath: '/media/avatars/girl-1.jpg'
        },
        {
          name: "girl-2.jpg",
          filePath: "/media/avatars/girl-2.jpg"
        },
        {
          name: "gamer.jpg",
          filePath: "/media/avatars/gamer.jpg"
        },
        {
          name: "gamer-app.jpg",
          filePath: "/media/avatars/gamer-app.jpg"
        }
      ]
    }
  },
  methods: {
    setImage: function (file) {
      this.hasImage = true;
      this.preview = true;
      this.image = file.name
      this.file = file;
      this.selected = null;

    },
    getValidationState({dirty, validated, valid = null}) {
      return dirty || validated ? valid : null;
    },
    async onSubmit() {
      let formData;
      let url = null;
      let user = this.$store.getters.users[this.$route.params.id];
      let method = "POST";
      let selectedAvatar = null;

      if (this.selected !== null && this.file === null) {

        selectedAvatar = true;

        formData = {
          imagePath: this.selected,
          user: user["@id"],
          user_id: user.id
        }

        url = "/api/media_objects/exist_avatar"

        if (user.mediaObjects[0]) {
          url = `/api/media_objects/exist_avatar/${user.mediaObjects[0].id}`
          method = "PUT";
        }
      }

      if (this.file !== null) {

        formData = new FormData();
        formData.append('file', this.file);

        if (user.mediaObjects[0]) {
          url = `/api/media_objects/${user.mediaObjects[0].id}`
        }

        formData.append('user', user.id);
      }

      if (this.file !== null || this.selected !== null) {
        this.$store.dispatch('upload', {formData, url, method, selectedAvatar}).then((resp) => {
          user.isOwner = true;
          user.edit = true;
          user.mediaObjects[0] = resp.data;
          this.$store.commit('users', user);
          this.$store.commit('auth_user', user)
          localStorage.setItem('auth_user', JSON.stringify(user))
          EventBus.$emit('userUpdated', user);
        })
      } else {
        this.$store.dispatch('message', {type: 'error', text: 'Hummm, tu as bien séléctioné une photo ? '});
      }

    },
  }
}

</script>

<style>
#fileInput {
  display: none;
}

#upload-icon {
  cursor: pointer;
}

</style>