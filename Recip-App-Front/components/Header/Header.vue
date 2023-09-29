<script setup>
    import Logo from '../../assets/Img/Logo_for_FoodX.png'
    import User from '../../assets/SVG/user.svg'

    import { useRoute } from 'vue-router';
    const route = useRoute();
    watch(() => route.path, (newPath) => {
        route.value = newPath;
    });
</script>

<template>
    <header>
        <div class="header--container">
            <div class="header--container--picture">
                <img :src="Logo" alt="Food'X Logo"/>
            </div>
            <div class="header--container--nav">
                <nav class="header--nav">
                    <ul>
                        <li><nuxt-link to="/" :class="{ 'active': route.path === '/' }">Acceuil</nuxt-link></li>
                        <li><nuxt-link to="/rechercher" :class="{ 'active': route.path === '/rechercher' }">Rechercher Un Plat</nuxt-link></li>
                        <li><nuxt-link to="/confectioner" :class="{ 'active': route.path === '/confectioner' }">Confectioner Un Plat</nuxt-link></li>
                        <li><nuxt-link to="/menus" :class="{ 'active': route.path === '/menus' }">Créer Vos Menus</nuxt-link></li>
                    </ul>
                </nav>
            </div>
            <div class="header--container--connexion">
                <span class="connexion--button">
                    <img :src="User" alt="User Logo"/>
                    <nuxt-link to="/connexion">Connexion</nuxt-link>
                </span>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            Logo: Logo,
            User: User,
        };
    },
}
</script>

<style lang='scss' scoped>
@use '../../style/variable.scss' as v;

header {
    width: 100%;
    height: v.$head--height;

    .header--container {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;

        &--picture {
            flex: 1;
            height: 100%;
            display: flex;
            justify-content: start;
            align-items: center;

            img {
                width: 100%;
                height: 120%;
                object-fit: contain;
            }
        }

        &--nav {
            flex: 3;
            height: 100%;
            display: flex;
            flex-direction: row;
            align-items: start;
            justify-content: end;

            .header--nav {
                background-color: v.$second--color;
                width: fit-content;
                height: 80%;
                border-bottom-left-radius: 54px;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);

                ul {
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: end;
                    gap: 1.5rem;
                    height: 100%;
                    padding: 0 0.5rem 0 1.5rem;

                    li {
                        list-style: none;
                        border-right: 1px solid v.$trait--color;
                        padding: 0 1.5rem;
                        height: 30px;
                        display: flex;
                        align-items: center;

                        a{
                            color: #111111; 
                            font-size: 20px; 
                            font-family: v.$text; 
                            font-weight: 400; 
                            word-wrap: "break-word";  
                            text-decoration: none;

                            &.active {
                                border-bottom: 1px solid #8F8F8F;
                            }
                        }

                        
                    }

                    li:last-child {
                        border-right: none;
                    }
                }
            }
        }

        &--connexion {
            position: absolute;
            bottom: -1rem;
            right: .5rem;

            .connexion--button {
                display: flex;
                background-color: v.$primary--color;
                height: 2rem;
                width: fit-content;
                border-radius: 12px;
                align-items: center;
                justify-content: space-evenly;
                gap: 1rem;
                padding: .2rem 1.5rem;

                img {
                    height: 80%;
                    object-fit: contain;
                }

                a {
                    text-decoration: none;
                    color: white;
                }
            }
        }
    }
}

</style>
