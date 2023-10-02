<template>
    <div class="card--plat">
        <NuxtLink :to="slug">
            <img :src="img" alt="image">
            <span class="timer"><Icon name="ion:ios-timer" style="color: #DD5D2C; width: 25px; height: 25px;"/>{{ timer }} min</span>
            <!-- <span class="favorite"><Icon name="streamline:interface-bookmark-double-bookmarks-double-tags-favorite" style="color: #DD5D2C; width: 25px; height: 25px;" /></span> -->
            <p class="name">{{ name }}</p>
        </NuxtLink>
    </div>
</template>

<script>

export default {
    name: 'CardPlat',
    props: {
        img : {
            type: String,
            default: ''
        },
        name : {
            type: String,
            default: ''
        },
        timer : {
            type: String,
            default: ''
        },
        slug : {
            type: String,
            default: ''
        },
    }, 
}
</script>

<style lang='scss' scoped>
@use '@/style/variable.scss' as v;

.card--plat {
    width: 30%;
    height: 30vh;
    position: relative;
    border-radius: 1rem;
    transition: all .3s ease-in-out;

    &:hover {
        transform: scale(1.03);
    }

    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        aspect-ratio: 16/9;
        border-radius: 1rem;
    }

    span, p {
        position: absolute;
        border-radius: 1rem;
    }

    .timer {
        top: 0;
        left: 0;
        padding: 0.5rem;
        background: linear-gradient(155deg, rgba(0,0,0,0.9136904761904762) 0%, rgba(0,0,0,0) 50%);
        border-radius: 1rem 0 .5rem 0;
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        width: 50%;
        height: 50%;
        display: flex;
        gap: .3rem;
    }

    .favorite {
        top: .5rem;
        right: .5rem;
    }

    .name {
        bottom: 0;
        left: 0;
        padding: 0.5rem;
        background: linear-gradient(0deg, rgba(0,0,0,0.9136904761904762) 0%, rgba(0,0,0,0) 100%);
        color: white;
        font-size: 1.2rem;
        font-weight: 400;
        width: 100%;
        height: 35%;
        display: flex;
        align-items: end;
        padding: 1rem;

        &:hover {
            text-decoration: underline;
        }
    }

}
</style>
