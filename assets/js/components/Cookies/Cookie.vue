<template>
  <footer>
    <cookie-law theme="royal">
      <div slot-scope="message">
        <p>
          En poursuivant votre navigation sur ce site, sans modifier le paramétrage de vos cookies, vous acceptez
          l'utilisation de cookies susceptibles de vous proposer des services, offres ou publicités adaptés à vos
          centres
          d'intérêts et de réaliser des statistiques de visites.
          <b-link href="https://www.cookiesandyou.com/">En savoir plus</b-link>
        </p>
      </div>
      <div slot-scope="props">
        <p>
          En poursuivant votre navigation sur ce site, sans modifier le paramétrage de vos cookies, vous acceptez
          l'utilisation de cookies susceptibles de vous proposer des services, offres ou publicités adaptés à vos
          centres
          d'intérêts et de réaliser des statistiques de visites.
          <b-link href="https://www.cookiesandyou.com/">En savoir plus</b-link>
        </p>
        <button class="btn btn-success" @click="props.accept"><span>Accepter</span></button>
        <button class="btn btn-danger" @click="props.close"><span>Décliner</span></button>
      </div>
    </cookie-law>
  </footer>
</template>

<script>
import CookieLaw from 'vue-cookie-law'

export default {
  components: {CookieLaw}
}
</script>