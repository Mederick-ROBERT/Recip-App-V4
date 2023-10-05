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

    const plat = ref(null);

    const fetchData = async () => {
        const data = await useFetch('http://localhost:8000/api/plat')
        plat.value = data;

        return plat.value.data
    }

    const homeSlider = async () => {
        const homeData = await useFetch('http://localhost:8000/api/plat')
        
        const array = []
        for (let i = 0; i < 5; i++) {
            array.push(homeData.data.value[i])
        }
        return array
    }

    const setDataFilter = async(data) => {
        console.log('RETURN DATA PLAT',plat)
        const setData = await useFetch('http://localhost:8000/api/filter', {
            body: data,
            method: 'POST'
        })
        plat.value = setData;
        console.log('RETURN DATA PLAT AFTER',plat)
        console.log('RETURN DATA',setData)
    }

    return {
        plat,
        fetchData,
        homeSlider,
        setDataFilter
    }
})

// await useFetch('http://localhost:8000/api/plat')

export const useOncePlatStore = defineStore('oncePlat', () => {

    const oncePlat = null;

    const getOncePlat = async (slug) => {
        const data = await useFetch(`http://localhost:8000/api/plat/${slug}`)
        return data.data
    }

    return {
        oncePlat,
        getOncePlat
    }
})
