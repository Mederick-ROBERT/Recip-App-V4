import { defineStore } from 'pinia'

export const useDataUser = defineStore('user' , () =>{
    const user = ref(null);
    const error = ref(null);

    const setRegister = async (data) => {
        const Data = await useFetch('http://localhost:8000/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        console.log('RETURN', Data.data.value.user)
        if(Data.error.value){
            error.value = Data.error.value.data.errors;
            return error.value
        }
        user.value = Data.data.value.user;
        return user.value
    }

    return {
        user,
        error,
        setRegister
    }
})
