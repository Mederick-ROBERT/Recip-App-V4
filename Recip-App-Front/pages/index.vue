<script setup>
    import HomePicture from '../assets/Img/home-picture.png'
    import HomeSlider from '~/components/Slider/HomeSlider.vue';

</script>

<template>
    <div class="home--container">
        <div class="home--container--picture">
            <div class="picture--container">
               <img :src="HomePicture" alt="Home Picture"/> 
            </div>
        </div>
        <div class="home--container--information">
            <div class="enter--text">
                <span><h1>Explorer un trésor de saveurs</h1></span>
                <div class="enter--text-information-animation">
                    <div class="enter--text-information">
                        <p>Notre collection de recettes variées à portée de clic</p>
                        <nuxt-link to="/rechercher">Cuisiner <Icon name="system-uicons:arrow-right" /></nuxt-link>  
                    </div>
                </div>
            </div>
            <div class="enter--slider">
                <HomeSlider />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            HomePicture: HomePicture,
        }
    },
}
</script>

<style lang='scss' scoped>
@use '~/style/variable.scss' as v;

.home--container {
    overflow-x: hidden;
    display: flex;
    height: calc(100vh - v.$head--height);
    gap: 2.5rem;

    &--picture {
        flex: 1;
        height: 100%;
        position: relative;

        .picture--container {
            display: flex;
            justify-content: start;
            align-items: center;
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: -60%;

            img {
                width: fit-content;
                height: 100%;
                object-fit: contain;
                animation: slideIn 1.1s ease-in-out;
                position: relative;
                z-index: 9;
                max-width: none;
            }
        }
    }

    &--information {
        flex: 3;
        height: 100%;
        display: flex;
        flex-direction: column;

        & .enter--text {
            flex: 1.5;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: start;
            justify-content: center;
            gap: 1rem;
            z-index: 9999;

            span {
                overflow-y: hidden;

               h1 {
                    font-family: v.$big--text;
                    color: v.$primary--color;
                    font-size: 60px;
                    font-weight: 400; 
                    word-wrap: "break-word";
                    margin-bottom: 2rem;
                    position: relative;
                    animation: textIn 1s ease-in-out;
                } 
            }
            

            & .enter--text-information-animation {
                overflow-y: hidden;

                & .enter--text-information {
                    display: flex;
                    flex-direction: column;
                    gap: 1rem;
                    padding-left: 2rem;
                    position: relative;
                    animation: textIn 1.3s ease-in-out;

                    p {
                        color: black; 
                        font-size: 22px; 
                        font-weight: 400; 
                        word-wrap: break-word;
                    }

                    a {
                        display: flex;
                        background-color: v.$primary--color;
                        width: fit-content;
                        border-radius: 12px;
                        align-items: center;
                        justify-content: space-evenly;
                        gap: 1rem;
                        padding: .5rem 1.2rem;
                        text-decoration: none;
                        color: white;
                        font-size: 18px; 
                        margin-left: 2rem;
                    }
                }
            }
        }

        & .enter--slider {
            flex: 1;
            position: relative;
            animation: sliderInBottom 1.5s ease-in-out;
        }
    }
}

@keyframes slideIn {
    0% {
        left: -100%;
        rotate: -90deg;
        
    }
    100% {
        left: 0%;
        rotate: 0deg;
    }
}

@keyframes textIn {
    0% {
        opacity: 0;
        bottom: -100%;
    }

    100% {
        opacity: 1;
        bottom: 0%;
    }
}

@keyframes sliderInBottom {
    0% {
        transform: translateY(100%);
        opacity: 0;
    }

    100% {
        transform: translateY(0%);
        opacity: 1;
    }
}
</style>
