<script setup>
    import Plat1 from '@/assets/Img/plat1.jpg'
    import IngredientSlider from '@/components/Slider/IngredientSlider.vue'
</script>

<template>
<span class="return"><NuxtLink to="/rechercher"><Icon name="material-symbols:arrow-left-alt-rounded" style="color: #DD5D2C; width: 30px; height: 30px;" /></NuxtLink></span>
    <div class="recip--container">
        <div class="recip--left">
            <h1>{{ recip.name }}</h1>
            <div class="ingredients">
                <h2><Icon name="fa6-solid:basket-shopping" style="color: #DD5D2C; width: 30px; height: 30px;" /> Ingredients</h2>
                <div class="slider">
                    <IngredientSlider />
                </div>
            </div>
            <div class="preparation">
                <h2><Icon name="streamline:food-kitchenware-chef-toque-hat-cook-gear-chef-cooking-nutrition-tools-clothes-hat-clothing-food" style="color: #DD5D2C; width: 30px; height: 30px;"/>Préparation</h2>
                <div class="etapes--all">
                    <div class="etape">
                        <h3>Étape 1</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi aliquid at velit eius assumenda tempora neque. Repellat quis vero distinctio. In, amet assumenda? Corporis perspiciatis numquam optio ab sit maiores?</p>
                    </div>
                    <div class="etape">
                        <h3>Étape 2</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi aliquid at velit eius assumenda tempora neque. Repellat quis vero distinctio. In, amet assumenda? Corporis perspiciatis numquam optio ab sit maiores?</p>
                    </div>
                    <div class="etape">
                        <h3>Étape 3</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi aliquid at velit eius assumenda tempora neque. Repellat quis vero distinctio. In, amet assumenda? Corporis perspiciatis numquam optio ab sit maiores?</p>
                    </div>
                </div>
            </div>
            <div class="comments">
                <h2><Icon name="material-symbols:comment-outline-rounded" style="color: #DD5D2C; width: 30px; height: 30px;"/> Commentaires</h2>
                <div class="comments--container">
                    <div class="comments--all">
                        <div class="comments--once">
                            <span class="name">Jhon Does</span>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At hic delectus assumenda adipisci nemo sed facilis saepe consequuntur quaerat.</p>   
                        </div>
                        <div class="comments--once">
                            <span class="name">Jhon Does</span>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At hic delectus assumenda adipisci nemo sed facilis saepe consequuntur quaerat.</p>   
                        </div>
                    </div>
                    <div class="comments--input">
                        <form>
                            <input type="text" name="comments" placeholder="Votre Commentaire ..."> <button type="submit"><Icon name="mingcute:send-plane-fill" style="color: #DD5D2C; width: 30px; height: 30px;"/></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="recip--right">
            <div class="recip--right--information">
                <div class="number--person">
                    <Icon name="tabler:users" style="color: black; width: 30px; height: 30px;" />
                    <div class="number--person--block">
                        <span class="plus"><Icon name="ic:round-add" style="color: #DD5D2C; width: 25px; height: 25px;"/></span>
                        <span class="number">{{ recip.person }}</span>
                        <span class="minus"><Icon name="gg:math-minus" style="color: #DD5D2C; width: 25px; height: 25px;"/></span>
                    </div>
                </div>
                <div class="preparation--time">
                    <span class="timer"><Icon name="ion:ios-timer" style="color: black; width: 30px; height: 30px;"/> {{ recip.timer }} min</span>
                    <span class="cooking"><Icon name="fe:kitchen-cooker" style="color: black; width: 30px; height: 30px;" /> {{ recip.cooking }} min</span>
                </div>
            </div>
            <div class="recip--right--picture">
                <img :src="recip.img" alt="image">
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            recip: {
                name: 'Tarte Avocat Mozarella',
                img: Plat1,
                timer: '30',
                cooking: '15',
                person: '4',
            }
        }
    }
}
</script>

<style lang='scss' scoped>
@use '@/style/variable.scss' as v;


.return {
    position: fixed;
    top: calc(v.$head--height - .5rem);
    left: .2rem;
}

.recip--container {
    background-color: v.$second--color;
    height: calc(100vh - v.$head--height);
    box-shadow: 0px -3px 10px rgba(0, 0, 0, 0.25); 
    border-top-left-radius: 80px; 
    border-top-right-radius: 80px;
    animation: openRecip 900ms ease-in-out;
    display: flex;
    gap: 1rem;
    overflow-y: hidden;
    padding: 1rem;
    padding-bottom: 0;
    position: relative;

    & .recip--left {
        flex: 2;
        overflow-y: scroll;
        overflow-x: hidden;
        height: 100%;
        margin-left: 1rem;

        &::-webkit-scrollbar {
            width: 0px;
        }

        & h1 {
            color: black; 
            font-size: 2.5rem; 
            font-weight: 400; 
            word-wrap: break-word;
            border-bottom: 1px solid v.$primary--color;
            width: fit-content;
            margin: 1rem 0;
        }

        & h2 {
            color: black; 
            font-size: 2rem; 
            font-weight: 400; 
            word-wrap: break-word;
            width: fit-content;
            margin-top: 2rem;
            display: flex;
            align-items: baseline;
            gap: .5rem;
        }

        & h3 {
            color: black; 
            font-size: 1.5rem; 
            font-weight: 400; 
            word-wrap: break-word;
            width: fit-content;
            margin: .5rem 0;
            display: flex;
            align-items: baseline;
            gap: .5rem;  
            border-bottom: 1px solid v.$primary--color;   
        }

        & .ingredients {

            & .slider {
                padding: 1rem;
                border-left: 1px solid v.$trait--color;
                margin-left: .8rem;
            }
        }

        & .preparation {

            & .etapes--all {
                padding: 1rem;
                border-left: 1px solid v.$trait--color;
                margin-left: .8rem;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
        }

        & .comments {

            & .comments--container {
                padding: 1rem;
                border-left: 1px solid v.$trait--color;
                margin-left: .8rem;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            & .comments--all {
                flex: 4;
                display: flex;
                flex-direction: column;
                gap: 1rem;

                & .comments--once {
                    display: flex;
                    flex-direction: column;
                    gap: .5rem;

                    & .name {
                        font-size: 1.1rem;
                        font-weight: 400;
                        color: v.$primary--color;
                        margin-left: .2rem;
                    }

                    & p {
                        font-size: .9rem;
                        font-weight: 400;
                        background-color: white;
                        padding: .8rem;
                        border-radius: 12px;
                    }
                }
            }

            & .comments--input {
                flex: 1;
                display: flex;
                flex-direction: row;
                gap: 1rem;
                border-top: 1px solid v.$trait--color;

                & form {
                    display: flex;
                    margin: 1rem 0;

                    input {
                        border: none;
                        outline: none;
                        padding: .5rem;
                        border-radius: 12px;
                        background-color: white;
                        flex: 1;
                        width: 180px;
                        transition: all 300ms ease-in-out;

                        &:focus {
                            width: 40vw;
                        }
                    }

                    button {
                        border: none;
                        outline: none;
                        cursor: pointer;
                        background-color: transparent;
                        margin-left: 1rem;
                    }
                }
            }
        }
    }

    & .recip--right {
        flex: 1;
        height: 100%;
        display: flex;
        flex-direction: column;

        &--information {
            flex: 1;
            display: flex;
            flex-direction: column;

            & .number--person {
                flex: 1;
                display: flex;
                padding: 0 3rem;
                align-items: center;
                gap: 1rem;

                &--block {
                    display: flex;
                    align-items: center;

                    & .plus {
                        padding: .1rem .3rem;
                        border: 2px solid v.$trait--color;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 10px 0 0 10px;
                        cursor: pointer;
                    }

                    & .number {
                        padding: .13rem .8rem;
                        border: 2px solid v.$trait--color;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-left: none;
                        border-right: none;
                        font-size: 1.3rem;
                        color: v.$primary--color;
                    }

                    & .minus {
                        padding: .1rem .3rem;
                        border: 2px solid v.$trait--color;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 0 10px 10px 0;
                        cursor: pointer;
                    }
                }

            }

            & .preparation--time {
                flex: 1;
                display: flex;
                padding: 0 3rem;
                gap: 2rem;
                color: v.$primary--color;
                font-size: 1.3rem;
            }
        }

        &--picture {
            flex: 2;

            & img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 30% 70% 70% 30% / 30% 26% 74% 70% ;
                filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
            }
        }
    }
}

@keyframes openRecip {
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
