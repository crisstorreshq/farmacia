import React from 'react';
import { TextField } from '@material-ui/core';
import { Autocomplete } from '@material-ui/lab'
import { useField, useFormikContext } from 'formik';

const Select = ({ name, ...props }) => {
  const { setFieldValue, handleBlur } = useFormikContext();
  const [field, meta] = useField(name);

  const handleChange = (evt, value) => {
    setFieldValue(name, value);
  };

  const configSelect = {
    ...field,
    ...props,
    fullWidth: true,
    onOpen: handleBlur(name),
    blurOnSelect: false,
    onChange: handleChange,
  };

  let errores = {
    error: false
  }

  if (meta && meta.touched && meta.error) {
    errores.error = true;
    errores.helperText = "Debe seleccionar una opción";
  }

  return (
    <Autocomplete
      {...configSelect}
      renderInput={(params) => (
        <TextField
          {...params}
          style={{"marginTop":"12px","marginBottom":"12px"}}
          label= {props.label}
          variant="standard"
          {... errores}
        />
      )}
    />
  )
}

export default Select