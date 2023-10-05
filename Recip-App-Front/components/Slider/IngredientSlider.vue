<script setup>
import VueSplide from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
import { defineProps } from 'vue';

import Avocat from '~/assets/Img/avocat.png';
import Moza from '~/assets/Img/moza.jpg';
import Butter from '~/assets/Img/Butter.jpg';

const props = defineProps([
  'ingredients',
  'numberPersonn',
  'initialPersonn'
])

const ingredients = props.ingredients;
console.log(...ingredients)

const options = {
      rewind: true,
      gap   : '1rem',
      perPage: 4,
      arrows: false,
      height: '200px',
      padding: { top: '1rem', bottom: '1rem', right: '3rem', left: 0 },
      autoplay: true,
    };
</script>

<template>
    <Splide  :options="options" >
        <SplideSlide v-for="ingredient in ingredients" data-splide-interval="3000">
          <p>{{ props.numberPersonn }}</p>
          <div class="splide_card">
            <img class="picture--slide" :src="ingredient.ingredient.picture_url" alt="Sample 1" loading="lazy">
            <p>{{ ingredient.ingredient.name }}:&nbsp;<span>{{ (ingredient.quantity / initialPersonn * numberPersonn).toFixed(0) }} {{ ingredient.ingredient.unité_id }}</span></p>
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
            {name: 'Avocats', img: Avocat, prop: '2'},
            {name: 'Mozarella', img: Moza, prop: '150g'},
            {name: 'Beurre', img: Butter, prop: '100g'},
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
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.15 );
}

.picture--slide {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: .5rem;
}

p {
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: start;
  padding: 1rem;
  background: linear-gradient(0deg, rgba(0,0,0,0.9136904761904762) 0%, rgba(0,0,0,0) 100%);
  border-radius: 0 0 .5rem .5rem;
  font-size: 20px;
  font-weight: 400;
  color: white;
  height: 40%;
  display: flex;
  align-items: end;


  span {
    color: #DD5D2C;
    font-weight: 600;
  }
}
</style>