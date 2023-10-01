<script setup>
import { ref, onMounted } from 'vue';

const range = ref(50);

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
        background-color: blue;
        height: calc(100vh - v.$head--height);
        overflow-y: scroll;
        overflow-x: hidden;
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
</style>
