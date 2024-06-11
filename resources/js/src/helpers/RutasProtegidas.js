import React, { useEffect, useState } from 'react'
import { Navigate, Outlet } from 'react-router-dom'
import api from './api'

const RutasProtegidas = ({idServicio}) => {
    const [idServicioBack, setIdServicio] = useState(null)

    const getIdServicio = () => {
        api.getAuth().then(data => setIdServicio(data.data.perfil.id_servicio))
    }

    useEffect(() => {
        getIdServicio()
    }, [])

    return idServicioBack !== null ? 
        ( idServicio == idServicioBack || 14 == idServicioBack ? <Outlet/> : <Navigate to='404'/> ) 
        : null
}

export default RutasProtegidas