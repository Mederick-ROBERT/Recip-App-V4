<script setup>
import VueSplide from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';

import Plat1 from '~/assets/Img/plat1.jpg'
import Plat2 from '~/assets/Img/plat2.jpg'
import Plat3 from '~/assets/Img/plat3.jpg'
import Plat4 from '~/assets/Img/plat4.jpg'

import { usePlatStore } from '~/store/plat'
const store = usePlatStore()
const data = await store.homeSlider()

const plats = [
    ...data.map((plat) => ({
      name: plat.name,
      img: plat.picture_url,
    })),
    { name: 'plat1', img: Plat1 },
    { name: 'plat2', img: Plat2 },
    { name: 'plat3', img: Plat3 },
    { name: 'plat4', img: Plat4 },
  ]

const options = {
      rewind: true,
      gap   : '1rem',
      perPage: 3,
      arrows: false,
      type: 'loop',
      height: '200px',
      padding: { top: '1rem', bottom: '1rem', right: '3rem', left: 0 },
      autoplay: true,
      perMove : 1,
    };
</script>

<template>
    <Splide  :options="options" >
        <SplideSlide v-for="plat in plats" data-splide-interval="2000">
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
  background: linear-gradient(0deg, rgba(0,0,0,0.9136904761904762) 0%, rgba(0,0,0,0) 100%);
  border-radius: 0 0 .5rem .5rem;
  font-size: 22px;
  font-weight: 400;
  color: white;
}
</style>
