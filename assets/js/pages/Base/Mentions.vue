<template>
  <section>
    <b-container fluid>
      <b-row no-gutters>
        <b-col cols="12">
          <Jumbotron >
            <template  v-slot:header>
              <h2 class="text-center text-white"> Mentions Légales</h2>
            </template>

          </Jumbotron>
        </b-col>
      </b-row>
    </b-container>

    <b-container class="mt-5">
      <b-row>
        <b-col cols="12">
          <div class="text-justify">
            <p>Le site gamer-app.benpilliez.fr est édité par :</p>
            <p>Pilliez Benjamin<br>
              8, rue depoorter<br>
              59190 Hazebrouck<br>
              FRANCE</p>
            <h2>Hébergement</h2>
            <p>OVH, SAS au capital de 10 069 020 €<br>
              RCS Lille Métropole 424 761 419 00045<br>
              Code APE 2620Z<br>
              N° TVA : FR 22 424 761 419<br>
              Siège social : 2 rue Kellermann - 59100 Roubaix - France.</p>
            <h2>Contact</h2>
            <p>Email : admin@benpilliez.fr<br>
              Téléphone : 0607760215</p>
            <h2>Hébergeur</h2>

            <p>L'intégralité du contenu du site (textes, sons, images, photographies, schémas, logo, marques, etc.) est
              protégée par le droit de la propriété intellectuelle.
              Sous réserve des exceptions légales prévues par le Code de la Propriété Intellectuelle, toute reproduction
              et/ou
              communication de tout ou partie du contenu du site est soumise à autorisation préalable et expresse de
              l'agence
              Sofie.</p>
            <p>Ce site utilise Google Analytics, un service d'analyse de site internet fourni par Google Inc. (« Google »).
              Google Analytics utilise des cookies , qui sont des fichiers texte placés sur votre ordinateur, pour aider le
              site internet à analyser l'utilisation du site par ses utilisateurs. Les données générées par les cookies
              concernant votre utilisation du site (y compris votre adresse IP) seront transmises et stockées par Google sur
              des serveurs situés aux Etats-Unis. Google utilisera cette information dans le but d'évaluer votre utilisation
              du site, de compiler des rapports sur l'activité du site à destination de son éditeur et de fournir d'autres
              services relatifs à l'activité du site et à l'utilisation d'Internet. Google est susceptible de communiquer
              ces
              données à des tiers en cas d'obligation légale ou lorsque ces tiers traitent ces données pour le compte de
              Google, y compris notamment l'éditeur de ce site. Google ne recoupera pas votre adresse IP avec toute autre
              donnée détenue par Google. Vous pouvez désactiver l'utilisation de cookies en sélectionnant les paramètres
              appropriés de votre navigateur. Cependant, une telle désactivation pourrait empêcher l'utilisation de
              certaines
              fonctionnalités de ce site. En utilisant ce site internet, vous consentez expressément au traitement de vos
              données nominatives par Google dans les conditions et pour les finalités décrites ci-dessus.</p>
          </div>
        </b-col>
      </b-row>

    </b-container>
  </section>

</template>

<script>
import ButtonSidebar from "../../components/Menu/ButtonSidebar";
import Jumbotron from "../../components/Custom/Jumbotron";

export default {
  name:"Mentions",
  components:{ButtonSidebar,Jumbotron}
}

</script>

<style></style>

