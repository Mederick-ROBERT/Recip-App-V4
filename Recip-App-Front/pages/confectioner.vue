<script setup>
import Land from '@/assets/SVG/land.svg'

    onMounted(() => {

    })

    const numberPerson = ref(0)

    function addPerson() {
        numberPerson.value++
    }

    function removePerson() {
        if (numberPerson.value > 0){
            numberPerson.value--
        }
    }

    const heure1 = ref(0)
    const minute1 = ref(0)

    const heure2 = ref(0)
    const minute2 = ref(0)
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
                        <div class="preparation_time--timer--container">
                            <input class="counter" type="text" id="heure" :value="heure1" autocomplete="off">
                            <p>heure(s)</p>
                        </div>
                        <div class="preparation_time--timer--container">
                            <input class="counter" type="text" id="minute" :value="minute1" autocomplete="off">
                            <p>minute(s)</p>
                        </div>
                    </div>
                </div>
                <div class="input--type--2">
                    <input type="hidden" name="preparation_time">
                    <span class="label--input">Temps de Cuisson</span>
                    <div class="preparation_time--timer">
                        <div class="preparation_time--timer--container">
                            <input class="counter" type="text" id="heure" :value="heure2" autocomplete="off">
                            <p>heure(s)</p>
                        </div>
                        <div class="preparation_time--timer--container">
                            <input class="counter" type="text" id="minute" :value="minute2" autocomplete="off">
                            <p>minute(s)</p>
                        </div>
                    </div>
                </div>
                <div class="input--type--1">
                    <span class="label--input">Ingredients</span>
                    <div class="ingredients--container">
                        <span class="add--ingredients"><Icon name="ic:round-add" style="width: 25px; height: 25px;"/></span>
                    </div>
                </div>
                <div class="input--type--1">
                    <span class="label--input">Étapes</span>
                    <div class="ingredients--container">
                        <span class="add--ingredients"><Icon name="ic:round-add" style="width: 25px; height: 25px;"/></span>
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
                            <img :src="Land" alt="land for input">
                            <p>Ajouter une image</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    mounted() {

    }
}
</script>

<style lang='scss' scoped>
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
                    transition: all .3s ease-in-out;

                    &:focus {
                        outline: none;
                    }
                }

                & .ingredients--container {
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
                    // overflow: hidden;

                    & .input--picture {
                        width: 100%;
                        height: 100%;
                        opacity: 0;
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

                
            }
        }


    }
}

.text {
    color: black;
    font-size: 12px;
    font-weight: 400;
    word-wrap: break-word;
}
</style>
