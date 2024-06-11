import React, { useState } from 'react';
import Autocomplete from '@material-ui/lab/Autocomplete';
import TextField from '@material-ui/core/TextField';

const CustomAutocomplete = ({ options }) => {
  const [selectedOptions, setSelectedOptions] = useState([]);

  const handleOptionChange = (_, value) => {
    setSelectedOptions(value);
  };

  const handleQuantityChange = (optionValue, event) => {
    const quantity = parseInt(event.target.value, 10);
    setSelectedOptions((prevSelectedOptions) => {
      const updatedOptions = prevSelectedOptions.map((option) =>
        option.id === optionValue ? { ...option, quantity } : option
      );
      return updatedOptions;
    });
  };

  return (
    <div>
      <Autocomplete
        id="arrayPrestacion"
        name="arrayPrestacion"
        multiple
        options={options.filter(
          (option) => !selectedOptions.some((selected) => selected.id === option.id)
        )}
        getOptionLabel={(option) => option.name}
        value={selectedOptions}
        onChange={handleOptionChange}
        renderOption={(option) => (
          <div>
            {option.name}
          </div>
        )}
        renderInput={(params) => (
          <TextField
            {...params}
            variant="outlined"
            label="Opciones"
            placeholder="Selecciona una o varias opciones"
          />
        )}
      />
      <div>
        {selectedOptions.map((selectedOption) => (
          <div key={selectedOption.id}>
            {selectedOption.name}
            <TextField
              type="number"
              value={selectedOption.quantity || ''}
              onChange={(event) => handleQuantityChange(selectedOption.id, event)}
            />
          </div>
        ))}
      </div>
    </div>
  );
};

export default CustomAutocomplete;
