import React from 'react';
import { TextField } from '@material-ui/core';
import { useField } from 'formik';

const DateTimeMUI = ({ name, ...otherProps }) => {
    const [field, mata] = useField(name);

    const configTextfield = {
        ...field,
        ...otherProps,
        type:"date",
        fullWidth: true,
        variant: 'standard',
    };

    if (mata && mata.touched && mata.error) {
        configTextfield.error = true;
        configTextfield.helperText = mata.error;
    }

  return (
    <TextField
        style={{"marginTop":"12px","marginBottom":"12px"}}
        {...configTextfield} 
        InputLabelProps={{
            shrink: true,
        }}
    />
  );
};

export default DateTimeMUI;