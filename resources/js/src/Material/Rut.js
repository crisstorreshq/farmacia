import React, { useState } from 'react';
import { useField, useFormikContext } from 'formik';
import { TextField } from '@material-ui/core';
import HelperRut from './../helpers/Rut'

const Rut = ({ name, ...otherProps }) => {
    const { setFieldValue } = useFormikContext();
    const [field, meta] = useField(name);
    const [rutValido, setRutValido] = useState(false)
    
    const handleChange = ({target}) => {
        if(rutValido)
        {
            meta.error = "RUT Inválido"
        }
        setFieldValue(name, target.value);
    };

    const configTextfield = {
      ...field,
      ...otherProps,
      fullWidth: true,
      variant: 'standard',
    };
  
    let errores = {
        error: false
    }

    if (meta && meta.touched && meta.error)
    {
        errores.error = true
        errores.helperText = meta.error
    }

    return (
        <>
            <HelperRut
                onValid={setRutValido}
                {...configTextfield}
            >
                <TextField
                    {...configTextfield}
                    variant="standard" 
                    style={{"marginTop":"12px","marginBottom":"12px"}}
                    {...errores}
                />
            </HelperRut>
        </>
    )
}

export default Rut