import { defineStore } from 'pinia'

export const usePlatStore = defineStore('plat', () => {
    // state: () => ({
    //     plat: 'ok',
    // }),
    // getters: {
    //     getPlat: (state) => {
    //         return state.plat
    //     }
    // },
    // actions: {
    //     async setPlat() {    
    //         try {
    //             const data = await useFetch('http://localhost:8000/api/plat')
    //             console.log(data)
    //             this.plat = data.data
    //         }   
    //         catch (error) {
    //             console.log(error)
    //             return error
    //         }   
    //     },
    // }

    const plat = useFetch('http://localhost:8000/api/plat');

    const fetchData = async () => {
        const data = await plat
        console.log('STORE', plat.data.value)
        return plat.data.value
    }

    const homeSlider = async () => {
        const data = await plat
        
        const array = []
        for (let i = 0; i < 5; i++) {
            array.push(plat.data.value[i])
        }
        console.log('STORE2', array)
        return array
    }

    return {
        plat,
        fetchData,
        homeSlider
    }
})

// await useFetch('http://localhost:8000/api/plat')