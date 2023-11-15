<script setup>
import { useDataUser } from '~/store/user.js';

definePageMeta({
    layout: 'login',
})

const store = useDataUser();

const toast = useToast();

onMounted(() => {

    // password controller

    const caractere = document.querySelector('.caractere');
    const majuscule = document.querySelector('.majuscule');
    const chiffre = document.querySelector('.chiffre');

    const password = document.querySelector('#password');

    password.addEventListener('keyup', () => {
        const passwordValue = password.value;

        if (passwordValue.length >= 8) {
            caractere.style.color = '#11cc40';
        } else {
            caractere.style.color = '#A4A4A4';
        }

        if (passwordValue.match(/[A-Z]/)) {
            majuscule.style.color = '#11cc40';
        } else {
            majuscule.style.color = '#A4A4A4';
        }

        if (passwordValue.match(/[0-9]/)) {
            chiffre.style.color = '#11cc40';
        } else {
            chiffre.style.color = '#A4A4A4';
        }
    })

    // password visibility

    const eye = document.querySelector('.eye--close');

    eye.addEventListener('click', () => {
        if (password.type === 'password') {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
    })

    // Register form

    const form = document.querySelector('.sign-in--form');
    const container = document.querySelector('.button--submit');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const data = Object.fromEntries(formData);

        if(!await store.setRegister(data)){
            console.log('ERROR',store.error);
            document.querySelectorAll('.error').forEach((error) => {
                error.remove();
            })

            for(const error in store.error){
                let newError = document.createElement('p');
                newError.innerHTML = store.error[error][0];
                newError.classList.add('error');
                container.prepend(newError);
            }
        } else {
            form.reset();
            toast.add({ title: 'Inscription réussi', timeout: 2000, color: 'orange', icon : "i-heroicons-check-badge", description: 'Vous allez être redirigé vers votre dashboard' })
        }


    })

})
</script>

<template>
       <div class="login--container">
        <UNotifications />
            <div class="left--side">
                <div class="picture--background">
                    <div class="logo">
                        <nuxt-link to="/"><NuxtImg format="webp" src="/LoginPicture/Logo_for_FoodX.png" alt="logo" height="110" width="100%" fit="contain" /></nuxt-link>
                    </div>
                    <div class="back-texte">
                        <div class="top--texte">
                            <h1>Rejoignez notre Univers</h1>
                            <p>Découvrez des centaines de recettes à préparer en un instant ! Inscrivez-vous dès maintenant pour accéder à une variété de délices culinaires à porté de clic.</p>
                        </div>
                        <div class="bottom-texte">
                            <p>Déja membre ? <nuxt-link to="#">Connectez-vous</nuxt-link></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right--side">
                <div class="title">
                    <h2>Bienvenue sur Food'<span style="color: #DD5D2C;">X</span></h2>
                    <p>Créer votre profil</p>
                </div>
                <div class="formulaire">
                    <form class="sign-in--form">
                        <div class="double--input">
                            <div class="input--class">
                                <label for="firstname">Votre Nom</label>
                                <input type="text" name="firstname" id="firstname">
                            </div>
                            <div class="input--class">
                                <label for="lastname">Votre Prénom</label>
                                <input type="text" name="lastname" id="lastname">
                            </div>
                        </div>
                        <div class="single--input">
                            <div class="input--class">
                                <label for="email">Votre Adresse Mail</label>
                                <input type="text" name="email" id="email">
                            </div>
                        </div>
                        <div class="single--input">
                            <div class="input--class">
                                <label for="password">Votre Mot de Passe</label>
                                <input type="password" name="password" id="password">
                                <span class="eye--close"><Icon name="solar:eye-closed-outline" size="20px" /></span>
                            </div>
                        </div>
                        <div class="info">
                            <p class="caractere">* Minimum 8 caractères</p>
                            <p class="majuscule">* Minimum 1 majuscule</p>
                            <p class="chiffre">* Minimum 1 chiffre</p>
                        </div>
                        <div class="button--submit">
                            <button type="submit">Rejoindre</button>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="google">
                    <p>Continuez avec </p>
                    <Icon name="logos:google-icon" size="20px" />
                </div>
            </div>
       </div>
</template>

<style lang='scss'>
@use '../style/variable.scss' as v;

.login--container {
    display: flex;
    flex-direction: row;
    gap: 4rem;
    margin: 1rem 2rem;
    height: 95vh;

    .left--side {
        flex: 1;
        height: 100%;
        width: 100%;

        .picture--background {
            background-image: url('/LoginPicture/Background.jpg');
            background-size: cover;
            background-repeat: none;
            width: 100%;
            height: 100%;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: 2rem;

            .logo {
                width: 100%;
                height: 18%;
                padding: .5rem;

                a {
                    width: 100%;
                    height: 100%;
                    display: flex;
                    justify-content: start;
                    align-items: center;
                }
            }

            .back-texte {
                color: white;
                display: flex;
                flex-direction: column;
                gap: 1rem;
                padding: 1rem 3rem 2rem 3rem;

                .top--texte {
                    display: flex;
                    flex-direction: column;
                    gap: .5rem;

                    & h1 {
                        text-align: start;
                        text-shadow: 0px 4px 4px #000;
                        font-size: 42px;
                        font-style: normal;
                        font-weight: 800;
                        line-height: normal;
                        text-transform: capitalize;
                    }

                    & p {
                        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.80);
                        font-size: 18px;
                        font-style: normal;
                        font-weight: 500;
                        line-height: normal;
                    }
                }

                .bottom-texte {
                    
                    & p {
                        text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.80);
                        font-size: 15px;
                        font-style: normal;
                        font-weight: 500;
                        line-height: normal;

                        & a {
                            font-weight: 700;

                            &:hover {
                                text-decoration: underline;
                            }
                        }
                    }
                }
            }
        }
    }

    .right--side {
        flex: 1.5;
        display: flex;
        justify-content: space-evenly;
        flex-direction: column;
        margin-left: 5rem;
        
        .title {

            & h2 {
                font-size: 40px;
                font-weight: 500;
            }
        }

        .sign-in--form {
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            gap: 1rem;
            width: 85%;

            .double--input {
                display: flex;
                gap: 3rem;
                justify-content: space-between;
            }

            .input--class {
                display: flex;
                flex-direction: column;
                position: relative;
                width: 100%;

                & label {
                    color: #A4A4A4;
                }

                & input {
                    border-radius: 6px;
                    border: 1px solid #A4A4A4;
                    min-width: 80%;
                    padding: .5rem;

                    &:focus {
                        outline: none;
                        border: 1px solid #DD5D2C;
                    }
                }

                & .eye--close {
                    position: absolute;
                    right: 10px;
                    top: 50%;
                    cursor: pointer;
                }

                #password {
                    padding-right: 2.5rem;
                }
            }

            .info {
                color: #A4A4A4;
                font-size: 0.8rem;
            }

            .button--submit {
                margin: 1rem 0;
                width: 100%;
                text-align: center;
                position: relative;

                & button {
                    background-color: v.$primary--color;
                    width: 80%;
                    color: white;
                    padding: .5rem;
                    border-radius: 6px;

                    &:hover {
                        transform: scale(1.02);
                        transition: all 0.2s ease-in-out;
                    }
                }

                .error {
                    color: red;
                    font-size: 0.8rem;
                }
            }
        }

        & hr {
            width: 85%;
        }

        .google {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: .5rem;
            width: 85%;

            & p {
                color: #A4A4A4;
                font-size: 0.8rem;
            }
        }
    }
}
</style>
