const axios = window.axios;

const BASE_API_URL = `${process.env.MIX_APP_URL}`

export default{
    getAuth: () =>
        axios.get(`${BASE_API_URL}/getAuth`),
    logout: () =>
        axios.post(`${BASE_API_URL}/logout`),
    getTransportistas: () =>
        axios.get(`${BASE_API_URL}/getTransportistas`),
    getProveedores: () =>
        axios.get(`${BASE_API_URL}/getProveedores`),
    getProductos: () =>
        axios.get(`${BASE_API_URL}/getProductos`),
    storeAdquisiciones: (req) =>
        axios.post(`${BASE_API_URL}/adquisiciones`, req),
    }