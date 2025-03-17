import React, { useState, useEffect } from 'react';

import { Formik, Form, FieldArray } from 'formik';
import * as Yup from 'yup';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

import { makeStyles } from '@material-ui/core/styles';
import SaveIcon from '@material-ui/icons/Save';
import HighlightOffIcon from '@material-ui/icons/HighlightOff';
import DeleteIcon from '@material-ui/icons/Delete';
import AddIcon from '@material-ui/icons/Add';

import { Button, Grid, IconButton } from '@material-ui/core';

import PageContainer from '../../../@jumbo/components/PageComponents/layouts/PageContainer';
import CmtCard from '../../../@coremat/CmtCard';
import CmtCardHeader from '../../../@coremat/CmtCard/CmtCardHeader';
import CmtCardContent from '../../../@coremat/CmtCard/CmtCardContent';

import TextField from './../../../Material/TextField'
import Select from './../../../Material/Select'

import api from './../../../helpers/api';

const useStyles = makeStyles((theme) => ({
  botonVerde: {
    background: 'linear-gradient(45deg, #00CC00 30%, #00e600 90%)',
    marginTop: '30px',
  },
  button: {
    marginTop: '30px',
  },
}));

const FORM_VALIDATION = Yup.object().shape({
  proveedor: Yup
    .object()
    .required('Proveedor es requerido'),
  factura_guia_oc: Yup
      .string()
      .required('Factura/Guía/OC es requerido'),
  monto: Yup
    .number()
    .required('Monto es requerido')
    .positive('Debe ser un número positivo'),
  transportista: Yup
    .object()
    .required('Transportista es requerido'),
  cantidad_bultos: Yup
    .number()
    .required('Cantidad de bultos es requerido')
    .positive('Debe ser un número positivo'),
  presentacion: Yup
    .object()
    .required('Presentación es requerida'),
  destinatario: Yup
    .object()
    .required('Destinatario es requerido'),
  recibe: Yup
    .string()
    .required('Recibe es requerido'),
  tens: Yup
    .object()
    .required('TENS es requerido'),
  qf: Yup
    .object()
    .required('QF es requerido'),
  items: Yup.array().of(
    Yup.object().shape({
    cod_externo: Yup
      .string()
      .required('Cod. Externo es requerido'),
    cod_interno: Yup
      .object()
      .required('Cod. Interno es requerido'),
    })
  ),
});

const initialValues = {
  proveedor: null,
  factura_guia_oc: '',
  monto: '',
  transportista: null,
  cantidad_bultos: '',
  presentacion: null,
  destinatario: null,
  recibe: '',
  tens: null,
  qf: null,
  items: [
    {
      cod_externo: '',
      cod_interno: null,
      descripcion: '',
    },
  ],
};

const Index = () => {
  const classes = useStyles();
  const MySwal = withReactContent(Swal);

  const [selProveedores, setSelProveedores] = useState([]);
  const [selTransportistas, setSelTransportistas] = useState([]);
  const [selProductos, setSelProductos] = useState([]);
  const [selTens, setSelTens] = useState([]);
  const [selQf, setSelQf] = useState([]);

  const selPresentacion = [
    { id: 1, name: 'Bolsa' },
    { id: 2, name: 'Caja' },
    { id: 3, name: 'Bandeja Plástica' },
    { id: 4, name: 'Sobre' },
    { id: 5, name: 'Otro' },
    { id: 6, name: 'Carga Refrigerada' },
  ];

  const selDestino = [
    { id: 1, name: 'Pabellon' }
  ]

  const fetchProveedores = async () => {
    try {
      const res = await api.getProveedores();
      setSelProveedores(res.data);
    } catch (err) {
      console.log(err);
    }
  };

  const fetchTransportistas = async () => {
    try {
      const res = await api.getTransportistas();
      setSelTransportistas(res.data);
    } catch (err) {
      console.log(err);
    }
  };

  const fetchProductos = async () => {
    try {
      const res = await api.getProductos();
      setSelProductos(res.data);
    } catch (err) {
      console.log(err);
    }
  };

  const fetchTensFarmacia = async () => {
    try {
      const res = await api.getProfesionales(11);
      setSelTens(res.data);
    } catch (err) {
      console.log(err);
    }
  };

  const fetchQfFarmacia = async () => {
    try {
      const res = await api.getProfesionales(18);
      setSelQf(res.data);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    fetchProveedores();
    fetchTransportistas();
    fetchProductos();
    fetchTensFarmacia();
    fetchQfFarmacia();
  }, []);

  return (
    <PageContainer>
      <Formik
        initialValues={initialValues}
        validationSchema={FORM_VALIDATION}
        onSubmit={(values, {resetForm}) => {
          const sentData = {
            'proveedor': values.proveedor?.id,
            'factura_guia_oc': values.factura_guia_oc,
            'monto': values.monto,
            'transportista': values.transportista?.id,
            'cantidad_bultos': values.cantidad_bultos,
            'presentacion': values.presentacion?.id,
            'destinatario': values.destinatario?.id,
            'recibe': values.recibe,
            'tens': values.tens?.id,
            'qf': values.qf?.id,
            'items': values.items,
          }
          api.storeDespachos(sentData)
            .then(res => {
              MySwal.fire({
                icon: 'success',
                title: '¡Formulario enviado!',
                text: res.data.message,
              })
              resetForm(( { values:  initialValues} ))
            })
            .catch(err => {
              MySwal.fire({
                icon: 'error',
                title: '¡Formulario enviado!',
                text: err,
              })
            })
        }}
      >
        {({ values, resetForm }) => (
          <Form>
            <CmtCard>
              <CmtCardHeader title="Registro de Caja" />
              <CmtCardContent>
                <Grid container spacing={3}>
                  <Grid item xs={3}>
                    <Select
                      name="proveedor"
                      label="Proveedor"
                      options={selProveedores}
                      getOptionLabel={(option) => `${option.rut} - ${option.name}` || ''}
                      getOptionSelected={(option, value) => option.id === value.id || ''}
                    />
                  </Grid>
                  <Grid item xs={3}>
                    <TextField 
                      name="factura_guia_oc" 
                      label="Factura/Guía/OC" 
                    />
                  </Grid>
                  <Grid item xs={3}>
                    <TextField 
                      name="monto" 
                      label="Monto" 
                      type="number" 
                    />
                  </Grid>
                  <Grid item xs={3}>
                    <Select
                      name="transportista"
                      label="Transportista"
                      options={selTransportistas}
                      getOptionLabel={(option) => option.name || ''}
                      getOptionSelected={(option, value) => option.id === value.id || ''}
                    />
                  </Grid>
                  <Grid item xs={3}>
                    <TextField 
                      name="cantidad_bultos" 
                      label="Cantidad de Bultos" 
                      type="number" 
                    />
                  </Grid>
                  <Grid item xs={3}>
                    <Select
                      name="presentacion"
                      label="Presentación"
                      options={selPresentacion}
                      getOptionLabel={(option) => option.name || ''}
                      getOptionSelected={(option, value) => option.id === value.id || ''}
                    />
                  </Grid>
                  <Grid item xs={3}>
                    <Select
                      name="destinatario"
                      label="Destinatario"
                      options={selDestino}
                      getOptionLabel={(option) => option.name || ''}
                      getOptionSelected={(option, value) => option.id === value.id || ''}
                    />
                  </Grid>
                  <Grid item xs={3}>
                    <TextField 
                      name="recibe" 
                      label="Recibe" 
                    />
                  </Grid>
                </Grid>
              </CmtCardContent>
            </CmtCard>

            <br />

            <CmtCard>
              <CmtCardHeader title="Encargado de Bodega" />
              <CmtCardContent>
                <Grid container spacing={3}>
                  <Grid item xs={6}>
                    <Select
                      name="tens"
                      label="TENS Farmacia"
                      options={selTens}
                      getOptionLabel={(option) => option.name || ''}
                      getOptionSelected={(option, value) => option.id === value.id || ''}
                    />
                  </Grid>
                  <Grid item xs={6}>
                    <Select
                      name="qf"
                      label="QF Farmacia"
                      options={selQf}
                      getOptionLabel={(option) => option.name || ''}
                      getOptionSelected={(option, value) => option.id === value.id || ''}
                    />
                  </Grid>
                </Grid>
              </CmtCardContent>
            </CmtCard>

            <br />

            <CmtCard>
              <CmtCardHeader title="Items" />
              <CmtCardContent>
                <FieldArray name="items">
                  {({ push, remove }) => (
                    <>
                      {values.items.map((_, index) => (
                        <Grid container spacing={3} key={index}>
                          <Grid item xs={4}>
                            <TextField 
                              name={`items.${index}.cod_externo`} 
                              label="Cod. Externo" 
                            />
                          </Grid>
                          <Grid item xs={4}>
                            <Select
                              name={`items.${index}.cod_interno`}
                              label="Cod. Interno"
                              options={selProductos}
                              getOptionLabel={(option) => `${option.id} - ${option.name}` || ''}
                              getOptionSelected={(option, value) => option.id === value.id || ''}
                            />
                          </Grid>
                          <Grid item xs={4}>
                            <TextField 
                              name={`items.${index}.descripcion`} 
                              label="Descripción" 
                            />
                          </Grid>
                          <Grid item xs={12}>
                            {values.items.length > 1 && (
                                <Grid item xs={12}>
                                <IconButton
                                    color="secondary"
                                    onClick={() => remove(index)}
                                >
                                    <DeleteIcon />
                                </IconButton>
                                </Grid>
                            )}
                          </Grid>
                        </Grid>
                      ))}
                        <IconButton
                            color="primary"
                            onClick={() => push({ cod_externo: '', cod_interno: null, descripcion: '' })}
                        >
                            <AddIcon />
                        </IconButton>
                    </>
                  )}
                </FieldArray>
              </CmtCardContent>
            </CmtCard>

            <br />

            <CmtCard>
              <CmtCardContent>
                <Grid container spacing={4}>
                    <Grid item xs={6}>
                        <Button 
                            className={classes.button} 
                            color="primary" 
                            variant="contained" 
                            fullWidth
                            startIcon={<HighlightOffIcon />}
                            onClick={
                                () => {
                                resetForm( 
                                    { values:  initialValues}
                                )
                                }}
                            size='large'
                        >
                            Limpiar Formulario
                        </Button>
                    </Grid>
                    <Grid item xs={6}>
                        <Button 
                            className={classes.botonVerde} 
                            variant="contained" 
                            fullWidth 
                            type="submit"
                            startIcon={<SaveIcon />}
                            size='large'
                        >
                            Guardar Prestación
                        </Button>
                    </Grid>
                </Grid>
              </CmtCardContent>
            </CmtCard>
          </Form>
        )}
      </Formik>
    </PageContainer>
  );
};

export default Index;
