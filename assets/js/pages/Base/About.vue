<template>
  <div>
    <jumbotron>
      <template v-slot:header>
        <b-row class="d-lg-block d-md-block d-sm-block d-none">
          <b-col class="d-flex justify-content-center">
            <h1 class="h1 text-center text-white pt-5">
              Gamer-app c'est quoi ? C'est qui ?
            </h1>
          </b-col>
        </b-row>
      </template>
    </jumbotron>

    <b-container :fluid=true class="p-4 mt-5">
      <b-row id="gamer-app-explain" class=" rounded p-5">
        <b-col cols="4" id="gamer-app">
        </b-col>
        <b-col cols="8" class="mb-4">
          <h4 class="text-center">Gamer-app c'est quoi ? </h4>

          <article>
            C'est une application web qui va vous permettre de rechercher des joueurs, de la même trempe (Casual,
            hardcore, Try-hardeur). Par la suite elle permettra aussi de suivre vos stats en game, ratio de W/L. Elle
            permettra également de vous attribuer un niveau de toxicité. Autant vous dire que les toxic ne vont pas
            faire long feu &#128540;.
          </article>
        </b-col>
      </b-row>
      <b-row id="gamer-app-author" class=" rounded mt-5 p-5">
        <b-col cols="8" class="mb-4">
          <h4 class=" text-center">Par qui ? </h4>
          <article>
            <p>
              Salut, bon je ne suis pas des plus doué pour ça alors ça va être très court &#128517; .
              Moi, c'est Pilliez Benjamin j'ai {{ calculedAge }} ans.
              Je suis un développeur web depuis maintenant {{ experience }} ans
              J'habite dans le nord, je suis un geek depuis mon plus jeune âge.
              J'ai commencé sur CS 1.6 (Ouai ça date) et je ne me suis toujours pas arrêté.
            </p>

            <p>Si j'ai décidé de réaliser ce projet, c'était avant tout pour me former car je suis en grande partie
              autodidact. J'avais envie de me lancer dans la conception d'une web-app avec vue-js, Symfony et
              api-platform (une single page app).
            </p>

            <em>Si vous avez des recommandations, sur l'ajout de fonction vous pouvez toujours me contacter via le
              formulaire de contact.</em>
          </article>
        </b-col>
        <b-col cols="4" id="author-background">
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import Jumbotron from "../../components/Jumbotron/Jumbotron";

export default {
  name: "About",
  computed: {
    calculedAge: function () {
      let currentDate = new Date();
      let birthDate = new Date('1991/05/08');
      let difference = currentDate - birthDate;
      return Math.floor(difference / 31557600000)
    },
    experience: function () {
      let currentDate = new Date();
      let exp = new Date('2019/04/01');
      let difference = currentDate - exp;
      return Math.floor(difference / 31557600000)
    }

  },
  components: {Jumbotron}
}
</script>
