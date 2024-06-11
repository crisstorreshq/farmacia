const axios = window.axios;

const BASE_API_URL = `${process.env.MIX_APP_URL}`

export default{
    getAuth: () =>
        axios.get(`${BASE_API_URL}/getAuth`),
    logout: () =>
        axios.post(`${BASE_API_URL}/logout`),
}
