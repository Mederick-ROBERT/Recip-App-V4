import { defineStore } from 'pinia'

export const useIngredientStore = defineStore('ingredients' , () =>{
    const ingredients = ref(null);

    const getIngredients = async () => {
        const data = await useFetch('http://localhost:8000/api/ingredients')
        ingredients.value = data;
        return ingredients.value.data
    }

    return {
        ingredients,
        getIngredients
    }
})
