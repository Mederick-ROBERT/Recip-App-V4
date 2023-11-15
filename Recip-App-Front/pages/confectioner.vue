<script setup>
import Land from '@/assets/SVG/land.svg';
import { useIngredientStore } from '~/store/ingredient';
import { createPlatStore } from '~/store/plat';


    // Person
    const numberPerson = ref(0)

    function addPerson() {
        numberPerson.value++
    }

    function removePerson() {
        if (numberPerson.value > 0){
            numberPerson.value--
        }
    }

    // préparation
    const heure1 = ref(0)
    const minute1 = ref(0)

    const final1 = ref(heure1.value + ':' + minute1.value)


    // cuisson
    const heure2 = ref(0)
    const minute2 = ref(0)

    const final2 = ref(heure2.value + ':' + minute2.value)


    // recherche d'ingredient

    const ingredients = useIngredientStore()
    const allIngredients = await ingredients.getIngredients()
    console.log(allIngredients)

    const search_ingredient = ref('');

    const allSearchIngredient = computed(() => {
        const filteredIngredients = [];

        allIngredients.forEach(ingredient => {
            if (ingredient.name.toLowerCase().startsWith(search_ingredient.value.toLowerCase())) {
                filteredIngredients.push(ingredient);
            }
        });

        return filteredIngredients;
    });


    // ajout d'ingredient

    function addIngredient(ingredient) {
        const id = ingredient.id;
        const name = ingredient.name;
        const unity = ingredient.unité_id;

        const ingredientsContainer = document.querySelector('.ingredients--container--all')
        const ingredients = document.createElement('div')
        ingredients.classList.add('ingredient--once')
        ingredients.setAttribute('data-target', id)
        ingredients.innerHTML = '<div class="data-one-ingredient"><span class="ingredient--name">' + name + '</span><input type="number" name="ingredient[]" class="counter" /><span class="ingredient--unity">' + unity + '</span></div>'
        
        ingredientsContainer.appendChild(ingredients)

        const ingredientPopUp = document.querySelector('.ingredient_pop-up')
        ingredientPopUp.classList.add('close_pop-up')
        
    }


    // preview d'image

    function previewImage() {
        const input = document.querySelector('input--picture');
        const preview = document.querySelector('previewImage');
        console.log(input)
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                preview.src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }


    // formulaire
    const createPlat = createPlatStore();

    const toast = useToast();

    onMounted(() => {
        // formulaire ----------------------------

        const formMenu = document.querySelector('.add--form button')

        formMenu.addEventListener('click', async function() {

            const formData = new FormData();
            const name = document.querySelector('#name').value
            const person = document.querySelector('input[name="person"]').value
            const type = document.querySelector('input[name="type"]').value
            const importance = document.querySelector('input[name="importance"]').value
            const picture = document.querySelector('#picture').files[0]

            const etapesElements = document.querySelectorAll('textarea[name="etapes[]"]');
            const etapes = [];
            etapesElements.forEach((etapesElement) => {
                etapes.push(etapesElement.value);
            });
            
            const ingredientsElements = document.querySelectorAll('input[name="ingredient[]"]');
            const ingredients = [];
            ingredientsElements.forEach((ingredientsElement) => {
                const dataTarget = ingredientsElement.parentElement.getAttribute('data-target');
                ingredients.push(dataTarget + '-' + ingredientsElement.value);
            });

            formData.append('name', name);
            formData.append('person', person);
            formData.append('type', type);
            formData.append('preparation_time', final1.value);
            formData.append('cooking_time', final2.value);
            formData.append('importance', importance);
            formData.append('picture', picture);
            formData.append('etapes', etapes);
            formData.append('ingredients', ingredients);

            const data = {
                name: name,
                person: person,
                preparation_time: final1.value,
                cooking_time: final2.value,
                type: type,
                importance: importance,
                picture: picture,
                ingredients: ingredients,
                etapes: etapes
            }

            console.log("AVANT =",data)

            const createAction = await createPlat.createPlat(formData);

            console.log("APRES =",createAction)

            // notification d'ajout
            toast.add({ title: 'Plat envoyé', timeout: 2000, color: 'orange' })
        })

        // etapes ----------------------------

        const moreEtapes = document.querySelector('.add--etapes')

        moreEtapes.addEventListener('click', function() {
            const etapesContainer = document.querySelector('.etapes--container--all')
            const etapes = document.createElement('div')
            etapes.classList.add('etapes--container--once')
            
            const textarea = document.createElement('textarea')
            textarea.classList.add('textarea--container')
            textarea.setAttribute('name', 'etapes[]')
            textarea.setAttribute('rows', '4')
            
            etapes.appendChild(textarea)
            
            // const removeEtape = document.createElement('span')
            // removeEtape.classList.add('remove--etape')
            // removeEtape.innerHTML = '<Icon name="gg:math-minus" style="color: #DD5D2C; width: 25px; height: 25px;"/>'
            
            // etapes.appendChild(removeEtape)
            
            etapesContainer.appendChild(etapes)
        })
        

        // ---------------------------- pop-up

        const addIngredients = document.querySelector('.add--ingredients svg')
        const ingredientPopUp = document.querySelector('.ingredient_pop-up')
        const crossClosePopUp = document.querySelector('.cross--close_pop-up')
        const ingredientOnce = document.querySelectorAll('.ingredient--once span')

        addIngredients.addEventListener('click', function() {
            ingredientPopUp.classList.remove('close_pop-up')
        })

        crossClosePopUp.addEventListener('click', function() {
            ingredientPopUp.classList.add('close_pop-up')
        })


        // ----------------------------

        const inputPicture = document.querySelector('.input--picture')
        const preview = document.querySelector('.previewImage')
        inputPicture.addEventListener('change', function() {
            if (inputPicture.files && inputPicture.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.add('withImage')
                }
                
                reader.readAsDataURL(inputPicture.files[0]);
            }
        })
    })

</script>

<template>
    <div class="confectioner--container">
        <h1>Créer un Nouveau Plat</h1>

        <div class="form--container">
            <div class="container--left">
                <div class="input--type--1">
                    <label for="name">Nom du Plat</label>
                    <input type="text" name="name" id="name" autocomplete="off">
                </div>
                <div class="input--type--2">
                    <input type="hidden" name="person" :value="numberPerson">
                    <span class="label--input">Nombre de Personne(s)</span>
                    <div class="number--person">
                        <div class="number--person--block">
                            <span class="plus" @click="removePerson"><Icon name="gg:math-minus" style="color: #DD5D2C; width: 25px; height: 25px;"/></span>
                            <span class="number">{{ numberPerson }}</span>
                            <span class="minus" @click="addPerson"><Icon name="ic:round-add" style="color: #DD5D2C; width: 25px; height: 25px;"/></span>
                        </div>
                    </div>
                </div>
                <div class="input--type--2">
                    <input type="hidden" name="preparation_time">
                    <span class="label--input">Temps de Préparation</span>
                    <div class="preparation_time--timer">
                        <input type="hidden" name="preparation_time" :value="final1">
                        <div class="preparation_time--timer--container">
                            <input class="counter" type="number" id="heure" v-model="heure1" autocomplete="off" v-on:change="final1 = heure1 + ':' + minute1">
                            <p>heure(s)</p>
                        </div>
                        <div class="preparation_time--timer--container">
                            <input class="counter" type="number" id="minute" v-model="minute1" autocomplete="off" v-on:change="final1 = heure1 + ':' + minute1">
                            <p>minute(s)</p>
                        </div>
                    </div>
                </div>
                <div class="input--type--2">
                    <input type="hidden" name="preparation_time">
                    <span class="label--input">Temps de Cuisson</span>
                    <div class="preparation_time--timer">
                        <input type="hidden" name="cooking_time" :value="final2">
                        <div class="preparation_time--timer--container">
                            <input class="counter" type="number" id="heure" v-model="heure2" autocomplete="off" v-on:change="final2 = heure2 + ':' + minute2">
                            <p>heure(s)</p>
                        </div>
                        <div class="preparation_time--timer--container">
                            <input class="counter" type="number" id="minute" v-model="minute2" autocomplete="off" v-on:change="final2 = heure2 + ':' + minute2">
                            <p>minute(s)</p>
                        </div>
                    </div>
                </div>
                <div class="input--type--1">
                    <span class="label--input">Ingredients</span>
                    <div class="ingredients--container">
                        <div class="ingredients--container--all">
                            
                        </div>
                        <span class="add--ingredients"><Icon name="ic:round-add" style="width: 25px; height: 25px;"/></span>
                    </div>
                </div>
                <div class="input--type--1">
                    <span class="label--input">Étapes</span>
                    <div class="ingredients--container">
                        <div class="etapes--container--all">
                            
                        </div>
                        <span class="add--etapes"><Icon name="ic:round-add" style="width: 25px; height: 25px;"/></span>
                    </div>
                </div>
                <div class="add--form">
                    <button>Ajouter</button>
                </div>
                <p class="text">Votre plat devra être validé par les administrateurs avant toute publication  </p>
            </div>
            <div class="container--right">
                <div class="input--type--3">
                    <span class="label--input">Type de Plat</span>
                    <div class="input--container">
                        <div class="content">
                            <span class="label">Entrée</span>
                            <label class="checkBox">
                                <input id="ch1" type="radio" name="type" value="1">
                                <div class="transition"></div>
                            </label>
                        </div>
                        <div class="content">
                            <span class="label">Plat</span>
                            <label class="checkBox">
                                <input id="ch1" type="radio" name="type" value="2">
                                <div class="transition"></div>
                            </label>
                        </div>
                        <div class="content">
                            <span class="label">Dessert</span>
                            <label class="checkBox">
                                <input id="ch1" type="radio" name="type" value="3">
                                <div class="transition"></div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="input--type--3">
                    <span class="label--input">Importance</span>
                    <div class="input--container">
                        <div class="content">
                                <span class="label">Midi</span>
                            <label class="checkBox">
                                <input id="ch1" type="radio" name="importance" value="1">
                                <div class="transition"></div>
                            </label>
                        </div>
                        <div class="content">
                            <span class="label">Soir</span>
                            <label class="checkBox">
                                <input id="ch5" type="radio" name="importance" value="2">
                                <div class="transition"></div>
                            </label>
                        </div>
                        <div class="content">
                            <span class="label">Semaine</span>
                            <label class="checkBox">
                                <input id="ch6" type="radio" name="importance" value="3">
                                <div class="transition"></div>
                            </label>
                        </div>
                        <div class="content">
                            <span class="label">Weekend</span>
                            <label class="checkBox">
                                <input id="ch7" type="radio" name="importance" value="4">
                                <div class="transition"></div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="input--type--3">
                    <span class="label--input">Image</span>
                    <div class="input--container">
                        <span class="before--input">
                            <input class="input--picture" type="file" name="picture" id="picture">
                            <img :src="Land" alt="land for input" class="previewImage">
                            <p>Ajouter une image</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="ingredient_pop-up close_pop-up">
            <div class="pop-up">
                <span class="cross--close_pop-up"><Icon name="ic:round-close" style="width: 20px; height: 20px; color: rgb(151, 151, 151);" /></span>
                <div class="search-bar--ingredient">
                    <input type="search" id="search-bar--ingredient" placeholder="Rechercher un ingredient..." v-model="search_ingredient" ><button><Icon name="ph:magnifying-glass" style="width: 35px; height: 35px; color: #DD5D2C;" /></button>
                </div>
                <div class="list--ingredient">
                    <ul>
                        <li class="ingredient--once" v-for="ingredient in allSearchIngredient" :key="ingredient.id" @click="addIngredient(ingredient)">
                            <span>{{ ingredient.name }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <UNotifications />
    </div>
</template>

<style lang='scss'>
@use '@/style/variable.scss' as v;
.confectioner--container {
    margin: 1rem 2rem;
    margin-top: 2.5rem;

    h1 {
        font-size: 32px;
        font-weight: 400;
        margin-bottom: 1rem;
        border-bottom: 2px solid v.$primary--color;
        width: fit-content;
        word-wrap: break-word;
    }

    label, .label--input {
        font-size: 1.2rem;
        border-bottom: 1px solid v.$primary--color;
        width: fit-content;
        margin-bottom: 1rem;
        height: fit-content;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        appearance: textfield;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    & .form--container{
        display: flex;
        border-left: 1px solid v.$trait--color;
        padding-left: 1rem;
        margin-top: 2rem;
        height: 64vh;
        overflow: scroll;

        & .container--left {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 1rem;

            & .input--type--1 {
                display: flex;
                flex-direction: column;
                margin: .5rem 0;

                & input[type="text"] {
                    background: #F6F6F6; 
                    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.05) inset; 
                    border-radius: 10px;
                    border: none;
                    padding: .5rem;
                    font-size: 1rem;
                    width: 70%;

                    &:focus {
                        outline: none;
                    }
                }

                & .data-one-ingredient {
                    display: flex;
                    flex-direction: row;
                    margin: 1rem .5rem;

                     & .ingredient--name {
                        background-color: white !important;
                        border: 1px solid v.$trait--color !important;
                        border-radius: 10px 0 0 10px !important;
                        padding: .3rem .5rem;
                    } 

                    & .counter {
                        border: 1px solid v.$trait--color !important;
                        border-left: none !important;
                        border-right: none !important;
                        width: 50px;
                        color: v.$primary--color;
                        text-align: end;

                        &:focus {
                            outline: none;
                        }
                    }

                    & .ingredient--unity {
                        background-color: white !important;
                        border: 1px solid v.$trait--color !important;
                        border-left: none !important;
                        border-radius: 0 10px 10px 0 !important;
                        padding: .3rem .5rem;
                    }
                }

                & .ingredients--container span {
                    display: block;
                    width: fit-content;
                    background-color: v.$trait--color;
                    border-radius: 5px;
                    cursor: pointer;
                }
            }

            & .input--type--2 {
                display: flex;
                flex-direction: row;
                gap: 3rem;
                align-items: start;
                margin: .5rem 0;


                & .number--person {
                    flex: 1;
                    display: flex;
                    padding: 0;
                    align-items: center;
                    gap: 1rem;

                    &--block {
                        display: flex;
                        align-items: center;

                        & .plus {
                            padding: .13rem .3rem;
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
                            font-size: 1.1rem;
                            color: v.$primary--color;
                        }

                        & .minus {
                            padding: .13rem .3rem;
                            border: 2px solid v.$trait--color;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 0 10px 10px 0;
                            cursor: pointer;
                        }
                    }

                }

                & .preparation_time--timer {
                    display: flex;
                    gap: 1rem;


                    &--container {
                        display: flex;
                        gap: .5rem;
                        align-items: baseline;


                        & .counter {
                            width: 4rem;
                            text-align: center;
                            color: v.$primary--color;
                            padding: .2rem .8rem;
                            border: 2px solid v.$trait--color;
                            border-radius: 10px 10px 10px 10px;
                            font-size: 1.2rem;

                            &:focus {
                                outline: none;
                            }
                        }

                    }
                }
            }

            & .add--form {
                display: flex;
                justify-content: center;


                button {
                    color: white;
                    font-size: 1rem;
                    border: none;
                    background-color: v.$primary--color;
                    padding: .5rem 20%;
                    border-radius: 8px;
                    cursor: pointer;

                    &:hover {
                        background-color: rgb(194, 74, 5);
                    }
                }
            }
        }

        & .container--right {
            flex: 1;


            & .input--type--3 {
                margin: 1.5rem 6rem;

                & .input--container {
                    padding-left: 1rem;
                    border-left: 1px solid v.$trait--color;
                    margin: 1rem;
                }

                input[type="radio"] {
                    display: none;
                }

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

                & .before--input {
                    display: block;
                    width: 9rem;
                    height: 7rem;
                    border: 1px dashed v.$trait--color;
                    border-radius: 10px;
                    padding: .2rem;
                    position: relative;
                    overflow: hidden;

                    & .input--picture {
                        width: 100%;
                        height: 100%;
                        opacity: 0;
                        position: relative;
                        z-index: 2;
                    }

                    & img {
                        position: absolute;
                        top: 10%;
                        left: 25%;
                        width: 50%;
                        height: 60%;
                        z-index: -1;
                    }

                    & p {
                        font-size: .8rem;
                        text-align: center;
                        margin-top: .2rem;
                        color: v.$trait--color;
                        position: absolute;
                        bottom: 5px;
                        width: 100%;
                    }
                }

                & .withImage {
                    width: 100% !important;
                    height: 100% !important;
                    z-index: 1 !important;
                    top: 0 !important;
                    left: 0 !important;
                }

                
            }
        }

    }
}

.etapes--container--once {
    position: relative;
}

.textarea--container {
    background: #F6F6F6; 
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.05) inset; 
    border-radius: 10px;
    border: none;
    padding: .5rem;
    font-size: 1rem;
    width: 70%;
    resize: none;

    &:focus {
        outline: none;
    }

    & .remove--etape {
        display: block;
        position: absolute;
        top: 0;
        right: 0;
        cursor: pointer;
    }
}

.text {
    color: black;
    font-size: 12px;
    font-weight: 400;
    word-wrap: break-word;
}

.ingredient_pop-up {
    width: 100vw;
    height: 100vh;
    position: fixed;
    z-index: 999999999999;
    top: 0;
    left: 0;
    backdrop-filter: blur(2px);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    & .pop-up {
        width: 35%;
        height: 85%;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0px 0px 17px 3px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        gap: .5rem;
        padding: 1rem;
        position: relative;

         & .cross--close_pop-up {
            position: absolute;
            top: .5rem;
            right: 1rem;
            cursor: pointer;
        }

        & .search-bar--ingredient {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 1rem;

            & input {
                border: none;
                border-bottom: 1px solid v.$primary--color;
                padding: .5rem 0;
                font-size: 1rem;
                width: 90%;
                font-size: 1.2rem;

                &:focus {
                    outline: none;
                }

                &::placeholder {
                    color: rgb(194, 194, 194);
                }
            }

            & button {
                border: none;
                background-color: transparent;
                cursor: pointer;
            }
        }

        & .list--ingredient {
            flex: 6;
            overflow-y: scroll;
            overflow-x: hidden;

            & ul {
                display: flex;
                flex-direction: column;
                gap: .5rem;
            }

            & li {
                list-style: none;
                border: 1px solid v.$trait--color;
                border-radius: 1rem;
                padding: .8rem;
                cursor: pointer;
                width: 95%;

                &:hover {
                    background-color: #F6F6F6;
                }
            }
        }
    }
}

.close_pop-up {
    display: none;
}
</style>
