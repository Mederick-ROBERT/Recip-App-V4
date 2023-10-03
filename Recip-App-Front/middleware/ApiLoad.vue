<script setup>
import { usePlatStore } from '~/store/plat'

const store = usePlatStore()
store.setPlat()
const dataAll = store.getPlat
console.log(dataAll) 

</script>

<template>
</template>