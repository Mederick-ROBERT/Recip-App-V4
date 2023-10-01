<script setup>
import VueSplide from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';

import Plat1 from '~/assets/Img/plat1.jpg'
import Plat2 from '~/assets/Img/plat2.jpg'
import Plat3 from '~/assets/Img/plat3.jpg'
import Plat4 from '~/assets/Img/plat4.jpg'

const options = {
      rewind: true,
      gap   : '1rem',
      perPage: 3,
      arrows: false,
      type: 'loop',
      height: '200px',
      padding: { top: '1rem', bottom: '1rem', right: '3rem', left: 0 },
      autoplay: true,
    };
</script>

<template>
    <Splide  :options="options" >
        <SplideSlide v-for="plat in plats" data-splide-interval="3000">
          <div class="splide_card">
            <img class="picture--slide" :src="plat.img" alt="Sample 1" loading="lazy">
            <p>{{ plat.name }}</p>
          </div>
        </SplideSlide>
  </Splide>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import { defineComponent } from 'vue';

export default defineComponent( {
  components: {
    Splide,
    SplideSlide,
  },

  data() {
    return {
        plats : [
            {name: 'plat1', img: Plat1},
            {name: 'plat2', img: Plat2},
            {name: 'plat3', img: Plat3},
            {name: 'plat4', img: Plat4},
        ]
    }
  },

} );
</script>

<style lang='scss' scoped>

.splide_card {
  height: 100%;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  border-radius: 5rem;
  padding: 1rem;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  position: relative;
  padding: 0;
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
}

.picture--slide {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 1rem;
}

p {
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: start;
  padding: 1rem;
  background: rgba(217, 217, 217, 0.68);
  backdrop-filter: blur( 0.5px );
  -webkit-backdrop-filter: blur( 0.5px );
  border: 1px solid rgba( 255, 255, 255, 0.18 );
  border-radius: 0 0 1rem 1rem;
  font-size: 22px;
  font-weight: 400;
}
</style>
