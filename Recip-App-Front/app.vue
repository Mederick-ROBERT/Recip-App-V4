<script setup>
import Header from '~/components/Header/Header.vue'
import ApiLoad from '~/middleware/ApiLoad.vue'

useSeoMeta({
  title: 'Food\'X',
  ogTitle: 'Food\'X',
  description: 'This is my amazing site, let me tell you all about it.',
  ogDescription: 'This is my amazing site, let me tell you all about it.',
})

</script>

<template>
  <div v-if="loading" class="loading-page">
    <span id="loader" class="loader"></span>
  </div>
  <!-- <ApiLoad v-if="!loading" /> -->
  <Header v-if="!loading" />
  <NuxtPage v-if="!loading" />
</template>

<script>
export default {
  data() {
    return {
      loading: true,
    };
  },
  mounted() {
    this.$nextTick(() => {
      setTimeout(() => {
        this.loading = false;
        const loader = document.querySelector('#loader');
        loader.classList.toggle('loader');
      }, 500);
    });
  },
  setup() {

  }
};
</script>

<style lang="scss">
@use '~/style/variable.scss' as v;

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: v.$text;
}

::-webkit-scrollbar {
  background-color: transparent;
  width: 3px;
  height: 3px;
}

::-webkit-scrollbar-thumb {
  background-color: v.$primary--color;
  border-radius: 0.5rem;
}

.loading-page {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #fff; 
  z-index: 99999; 
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.loader {
        transform: rotateZ(45deg);
        perspective: 1000px;
        border-radius: 50%;
        width: 88px;
        height: 88px;
        color: #f0f0f0;
      }
        .loader:before,
        .loader:after {
          content: '';
          display: block;
          position: absolute;
          top: 0;
          left: 0;
          width: inherit;
          height: inherit;
          border-radius: 50%;
          transform: rotateX(70deg);
          animation: 1s spin linear infinite;
        }
        .loader:after {
          color: v.$primary--color;
          transform: rotateY(70deg);
          animation-delay: .4s;
        }

      @keyframes rotate {
        0% {
          transform: translate(-50%, -50%) rotateZ(0deg);
        }
        100% {
          transform: translate(-50%, -50%) rotateZ(360deg);
        }
      }

      @keyframes rotateccw {
        0% {
          transform: translate(-50%, -50%) rotate(0deg);
        }
        100% {
          transform: translate(-50%, -50%) rotate(-360deg);
        }
      }

      @keyframes spin {
        0%,
        100% {
          box-shadow: .2em 0px 0 0px currentcolor;
        }
        12% {
          box-shadow: .2em .2em 0 0 currentcolor;
        }
        25% {
          box-shadow: 0 .2em 0 0px currentcolor;
        }
        37% {
          box-shadow: -.2em .2em 0 0 currentcolor;
        }
        50% {
          box-shadow: -.2em 0 0 0 currentcolor;
        }
        62% {
          box-shadow: -.2em -.2em 0 0 currentcolor;
        }
        75% {
          box-shadow: 0px -.2em 0 0 currentcolor;
        }
        87% {
          box-shadow: .2em -.2em 0 0 currentcolor;
        }
      }
   
</style>
