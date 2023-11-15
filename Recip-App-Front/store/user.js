import { defineStore } from 'pinia'

export const useDataUser = defineStore('user' , () =>{
    const user = localStorage.getItem('user') ? localStorage.getItem('user') : ref(null);
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

    const setLogin = async (data) => {
        const Data = await useFetch('http://localhost:8000/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        console.log('RETURN LOGIN = ', Data.data.value)
        user.value = Data.data.value.user;
        await setRemember()
        return user.value
    }

    const setRemember = async () => {
        localStorage.setItem('user', JSON.stringify(user.value))
        console.log('REMEMBER', localStorage.getItem('user'))
    }

    return {
        user,
        error,
        setRegister,
        setLogin
    }
})
