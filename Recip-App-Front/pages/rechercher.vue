<script setup>
import { ref, onMounted } from 'vue';
import SearchSlider from '~/components/Slider/SearchSlider.vue';
import CardPlat from '@/components/Card/CardPlat.vue';

const range = ref(50);

const numberPlat = ref(15)

</script>

<template>
    <div class="recherche--container">
        <div class="recherche--container--filtre">
            <form class="filtre--container">
                <div class="filtre--container--input">
                    <div class="input--open">
                        <span class="input--title">Importance <Icon name="material-symbols:arrow-back-ios-new-rounded" style="rotate: -90deg;" /></span>
                        <div class="input--open--check">
                            <div class="content">
                                <span class="label">Midi</span>
                                <label class="checkBox">
                                    <input id="ch1" type="checkbox" name="importance">
                                    <div class="transition"></div>
                                </label>
                            </div>
                            <div class="content">
                                <span class="label">Soir</span>
                                <label class="checkBox">
                                    <input id="ch5" type="checkbox" name="importance">
                                    <div class="transition"></div>
                                </label>
                            </div>
                            <div class="content">
                                <span class="label">Semaine</span>
                                <label class="checkBox">
                                    <input id="ch6" type="checkbox" name="importance">
                                    <div class="transition"></div>
                                </label>
                            </div>
                            <div class="content">
                                <span class="label">Weekend</span>
                                <label class="checkBox">
                                    <input id="ch7" type="checkbox" name="importance">
                                    <div class="transition"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="input--open">
                        <span class="input--title">Type de Plat <Icon name="material-symbols:arrow-back-ios-new-rounded" style="rotate: -90deg;" /></span>
                        <div class="input--open--check">
                            <div class="content">
                                <span class="label">Entrée</span>
                                <label class="checkBox">
                                    <input id="ch1" type="radio" name="type">
                                    <div class="transition"></div>
                                </label>
                            </div>
                            <div class="content">
                                <span class="label">Plat</span>
                                <label class="checkBox">
                                    <input id="ch1" type="radio" name="type">
                                    <div class="transition"></div>
                                </label>
                            </div>
                            <div class="content">
                                <span class="label">Dessert</span>
                                <label class="checkBox">
                                    <input id="ch1" type="radio" name="type">
                                    <div class="transition"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="input--open">
                        <span class="input--title">Temp de Préparation <Icon name="material-symbols:arrow-back-ios-new-rounded" style="rotate: -90deg;" /></span>
                        <div class="input--open--check">
                            <input type="hidden" name="preparation_time" :value="range">
                            <p class="cursor--range" :style="{ transform: 'translateX(' + (range - 20) + '%)' }"><span>{{ range }} min</span></p>
                            <input type="range" min="10" max="120" step="10" class="istyle" id="preparationTime" v-model="range">
                        </div>
                    </div>
                    <div class="input--open">
                        <span class="input--title">Ingrédients <Icon name="material-symbols:arrow-back-ios-new-rounded" style="rotate: -90deg;" /></span>
                        <div class="input--open--check">
                            <form class="input--search">
                                <input type="search" name="ingredient" id="ingre"> <Icon name="ph:magnifying-glass" />
                            </form>
                            <div class="ingredient--search">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filtre--container--button">
                    <button type="submit" class="input--button--submit">Rechercher</button>
                    <span class="input--button--reset">Réinitialiser</span>
                </div>
            </form>
        </div>
        <div class="recherche--container--plat">
            <div class="plat--slider">
                <div class="plat--search">
                    <form>
                        <input type="text" name="plat" id="plat" class="input--search--plat" > <Icon name="ph:magnifying-glass" style="color: #DD5D2C; width: 30px; height: 30px;" />
                    </form>
                </div>
                <div class="plat--slider">
                    <h2>Les Tendances De La Semaine</h2>
                    <div class="plat--slider--slider">
                        <SearchSlider />
                    </div> 
                </div>
            </div>
            <hr>
            <div class="plat--all">
                <h2>Tous les Plats </h2>
                <div class="plat--all--cards">
                    <CardPlat img="https://images.pexels.com/photos/1487511/pexels-photo-1487511.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" :name="name" :timer="timer" :slug="slug" v-for="n in numberPlat"/>
                </div>
                <div class="voir-plus">
                    <button ref="button" @click="numberPlat < 50 ? numberPlat += 10 : $refs.button.style.display='none'">Voir plus</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        const inputOpen = document.querySelectorAll('.input--title');

        for (const input of inputOpen) {
            input.addEventListener('click', () => {
                const caseInput = input.closest('.input--open').querySelector('.input--open--check');
                caseInput.classList.toggle('openInput');
            })
        }

        const search = document.querySelector('.input--search');
        const ingredientsCase = document.querySelector('.ingredient--search');

        search.addEventListener('submit', function (e) {
            e.preventDefault();

            const ingredient = document.createElement('span');
            
            // Créer un élément SVG
            const svgElement = document.createElementNS("http://www.w3.org/2000/svg", "svg");

            // Définir les attributs de l'élément SVG
            svgElement.setAttribute("xmlns", "http://www.w3.org/2000/svg");
            svgElement.setAttribute("width", "20px");
            svgElement.setAttribute("height", "20px");
            svgElement.setAttribute("viewBox", "0 0 16 16");

            svgElement.classList.add('cross');

            // Créer l'élément path
            const pathElement = document.createElementNS("http://www.w3.org/2000/svg", "path");

            // Définir les attributs du chemin
            pathElement.setAttribute("fill", "none");
            pathElement.setAttribute("stroke", "#888888");
            pathElement.setAttribute("stroke-linecap", "round");
            pathElement.setAttribute("stroke-linejoin", "round");
            pathElement.setAttribute("stroke-width", "1.5");
            pathElement.setAttribute("d", "m11.25 4.75l-6.5 6.5m0-6.5l6.5 6.5");

            // Ajouter l'élément path comme enfant de l'élément SVG
            svgElement.appendChild(pathElement);

            svgElement.style.cursor = 'pointer';
            ingredient.appendChild(svgElement);

            ingredient.classList.add('ingredientCase');
            ingredient.innerHTML += search.querySelector('input').value;

            const ingredientDB = document.createElement('input');
            ingredientDB.type = 'hidden';
            ingredientDB.name = 'ingredient[]';
            ingredientDB.value = search.querySelector('input').value;

            ingredient.appendChild(ingredientDB);
            ingredientsCase.appendChild(ingredient);
            

            search.reset()

            const crosses = document.querySelectorAll('.cross');
        
            for (const cross of crosses) {
                cross.addEventListener('click', () => {
                    cross.closest('span').remove();
                    cross.closest('ingredient--search').querySelector('input').remove();
                })
            }
        })

        
       
    },
    data() {
        return {
            name: 'Plat de test',
            timer: '30',
            slug: 'plat-de-test',
        }
    },
}
</script>

<style lang='scss'>
@use "@/style/variable.scss" as v;

.recherche--container {
    display: flex;
    overflow-x: hidden;
    width: 100%;

    &--filtre {
        flex: 1;
        height: calc(100vh - v.$head--height);
        display: flex;
        align-items: center;
        animation: filterIn 1s ease;

        & .filtre--container {
            width: 90%;
            height: 90%;
            background-color: v.$second--color;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-top-right-radius: 40px; 
            border-bottom-right-radius: 40px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            &--input {
                flex: 4;
                width: 100%;
                overflow-y: scroll;
                overflow-x: hidden;
                display: flex;
                flex-direction: column;
                gap: .5rem;

                & .input--open {

                    .input--title {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        padding: .2rem;
                        margin-right: 1rem;
                        cursor: pointer;
                        margin-bottom: .5rem;
                        font-size: 1.2rem;
                    }

                    &--check {
                        width: 80%;
                        margin-left: 15%;
                        border-left: 1px solid v.$trait--color;
                        padding: 0 1rem;
                        display: none;
                        flex-direction: column;
                        gap: .5rem;

                        .content {
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            margin-right: 1rem;
                        }

                        .clear {
                            clear: both;
                        }

                        .checkBox {
                            display: block;
                            cursor: pointer;
                            width: 20px;
                            height: 20px;
                            border: 3px solid rgba(255, 255, 255, 0);
                            border-radius: 5px;
                            position: relative;
                            overflow: hidden;
                            box-shadow: 0px 0px 0px 2px #CFCECE;
                        }

                        .checkBox div {
                            width: 60px;
                            height: 60px;
                            background-color: #CFCECE;
                            top: -52px;
                            left: -52px;
                            position: absolute;
                            transform: rotateZ(45deg);
                            z-index: 100;
                        }

                        .checkBox input[type=checkbox]:checked + div,
                        .checkBox input[type=radio]:checked + div {
                            left: -10px;
                            top: -10px;
                        }

                        .checkBox input[type=checkbox],
                        .checkBox input[type=radio] {
                            position: absolute;
                            left: 50px;
                            visibility: hidden;
                        }

                        .transition {
                            transition: 300ms ease;
                        } 

                        .input--search {
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                            width: 100%;
                            border: 1px solid v.$trait--color;
                            border-radius: 5px;
                            padding: .2rem .5rem;
                            background-color: #FFFFFF;

                            input {
                                border: none;
                                outline: none;
                                width: 90%;
                            }
                        }

                        .ingredient--search {
                            display: flex;
                            flex-direction: row;
                            gap: .5rem;
                            flex-wrap: wrap;

                            .ingredientCase {
                                width: fit-content;
                                background-color: #CFCECE;
                                padding: .1rem .5rem;
                                border-radius: .3rem;
                                display: flex;
                                align-items: center;
                            }
                        }
                        
                    }

                    
                }
            }

            &--button {
                flex: 1;
                border-top: 1px solid v.$trait--color;
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-evenly;

                & .input--button--submit {
                    background-color: v.$primary--color;
                    border: none;
                    width: 80%;
                    color: white;
                    padding: .5rem;
                    border-radius: 10px;
                    font-size: 1rem;
                    cursor: pointer;

                    &:hover {
                        background-color: #c53800;
                    }
                }

                & .input--button--reset {
                    font-size: 0.9rem;
                    width: 80%;
                    text-align: center;
                    padding: .5rem;
                    border-radius: 10px;
                    cursor: pointer;

                    &:hover {
                        background-color: #cfcece3b;
                    }
                }
            }
        }
    }

    &--plat {
        flex: 3.5;
        height: calc(100vh - v.$head--height);
        overflow-y: scroll;
        overflow-x: hidden;

        & .plat--search {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 999;

            & .input--search--plat {
                border: none;
                background: #F6F6F6; 
                box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.05) inset; 
                border-radius: 14px;
                padding: .3rem .8rem;
                color: black;
                width: 15vw;

                &:focus {
                    outline-color: v.$primary--color;
                }
            }
        }

        & .plat--slider {
            width: 100%;
            height: 30vh;
            position: relative;
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;

            & h2 {
                font-size: 24px;
                font-weight: 400;
                word-wrap: break-word;
                text-transform: capitalize;
                border-bottom: 2px solid v.$primary--color;
                width: fit-content;
            }

            &--slider {
                height: 80%;
                animation: enterInBottom 1s ease-in-out;
            }
        }

        & hr {
            width: 85%;
            margin: 1rem auto;
            border: 1px solid v.$trait--color;
        }

        & .plat--all {
            width: 100%;
            height: auto;

            & h2 {
                font-size: 24px;
                font-weight: 400;
                word-wrap: break-word;
                text-transform: capitalize;
                margin-bottom: 1rem;
                border-bottom: 2px solid v.$primary--color;
                width: fit-content;
            }

            &--cards {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 2rem;
                animation: enterInBottom 1.5s ease-in-out;
            }
        }
    }
}

.openInput {
    display: flex !important;
}

.cursor--range {
    width: 83%;
    max-width: 185px;

    span {
        display: block;
        clip-path: polygon(100% 0, 100% 67%, 67% 68%, 50% 100%, 30% 68%, 0 68%, 0 0);
        background-color: #000000;
        color: #FFFFFF;
        width: fit-content;
        padding: .2rem .2rem .8rem .2rem;
        border-radius: 3px;
        box-shadow: 0px 10px 15px -3px rgba(0,0,0,0.1);
        font-size: 0.7rem;
    }
}

input[type=range] {
  -webkit-appearance: none;
  margin: 10px 0;
  width: 100%;
  max-width: 210px;
}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 10px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 1px 1px 1px #ffffff;
  background: #000000;
  border-radius: 5px;
  border: 3px solid #ffffff;
}
input[type=range]::-webkit-slider-thumb {
  box-shadow: 1px 1px 1px #000000;
  border: 1px solid #000000;
  height: 21px;
  width: 7px;
  border-radius: 12px;
  background: #FFFFFF;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -7.5px;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: #000000;
}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 10px;
  cursor: pointer;
  animate: 0.2s;
  box-shadow: 1px 1px 1px #ffffff;
  background: #000000;
  border-radius: 5px;
  border: 3px solid #ffffff;
}
input[type=range]::-moz-range-thumb {
  box-shadow: 1px 1px 1px #000000;
  border: 1px solid #000000;
  height: 21px;
  width: 7px;
  border-radius: 12px;
  background: #FFFFFF;
  cursor: pointer;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 10px;
  cursor: pointer;
  animate: 0.2s;
  background: transparent;
  border-color: transparent;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  background: #000000;
  border: 3px solid #ffffff;
  border-radius: 10px;
  box-shadow: 1px 1px 1px #ffffff;
}
input[type=range]::-ms-fill-upper {
  background: #000000;
  border: 3px solid #ffffff;
  border-radius: 10px;
  box-shadow: 1px 1px 1px #ffffff;
}
input[type=range]::-ms-thumb {
  box-shadow: 1px 1px 1px #000000;
  border: 1px solid #000000;
  height: 21px;
  width: 7px;
  border-radius: 12px;
  background: #FFFFFF;
  cursor: pointer;
}
input[type=range]:focus::-ms-fill-lower {
  background: #000000;
}
input[type=range]:focus::-ms-fill-upper {
  background: #000000;
}

.voir-plus {
    width: 100%;
    text-align: center;
}

.voir-plus button {
   width: 200px;
    margin: 1.5rem auto;
    background-color: v.$primary--color; 
    color: white;
    padding: .5rem;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
}

@keyframes filterIn {
    0% {
        opacity: 0;
        transform: translateX(-100%);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes enterInBottom {
    0% {
        opacity: 0;
        transform: translateY(30%);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
