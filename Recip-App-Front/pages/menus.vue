<script setup>
const toast = useToast()
</script>

<template>
    <div>
        <h1>Menu</h1>
        <UButton label="Show toast" @click="toast.add({ title: 'Hello world!', timeout: 2000, color: 'orange' })" />
        <UNotifications />
    </div>
</template>

<script>

export default {
    mounted() {

    }
}
</script>

<style lang='scss'>

</style>
