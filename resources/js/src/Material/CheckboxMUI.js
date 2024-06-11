import React, { useState } from 'react';
import { Checkbox, FormControlLabel, FormControl, FormLabel, FormGroup } from '@material-ui/core';
import { useField, useFormikContext } from 'formik';

const CheckboxMUI = ({ name, label, checked, legend, ...otherProps }) => {
  const [selected, setSelected] = useState(false)
  const { setFieldValue } = useFormikContext();
  const [field, meta] = useField(name);

  const handleChange = evt => {
    const { checked } = evt.target
    setFieldValue(name, checked);
    setSelected(!selected)
  };

  const configCheckbox = {
    ...field,
    ...otherProps,
    onChange: handleChange,
    checked
  };

  const configError = {}

  if (meta && meta.touched && meta.error) {
    configError.error = true;
  }

  return (
    <FormControl {...configError} style={{"marginTop":"12px","marginBottom":"12px"}}>
      <FormLabel component="legend">{legend}: <code><strong>{selected ? 'SI' : 'NO' }</strong></code></FormLabel>
      <FormGroup>
        <FormControlLabel
          control = {<Checkbox {...configCheckbox} />}
          label={label}
        />
      </FormGroup>
    </FormControl>
  );
};

export default CheckboxMUI;