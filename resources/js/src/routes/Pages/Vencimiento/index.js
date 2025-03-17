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
import DateTime from './../../../Material/DateTimeMUI'

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
  tipo_adquisicion: Yup
    .object()
    .required('Tipo de adquisición es requerido'),
  fecha_recepcion: Yup
      .date()
      .required('Fecha de vencimiento es requerida'),
  transportista: Yup
    .object()
    .required('Transportista es requerido'),
  ot: Yup
    .string()
    .required('OT es requerido'),
  numero_bultos: Yup
    .number()
    .required('Número de bultos es requerido').positive('Debe ser un número positivo'),
  tipo_documento: Yup
    .object()
    .required('Tipo de documento es requerido'),
  numero_oc: Yup
    .number()
    .required('Número de OC es requerido').positive('Debe ser un número positivo'),
  proveedor: Yup
    .object()
    .required('Proveedor es requerido'),
  insumos: Yup
    .array()
    .of(
    Yup
      .object()
      .shape({
      producto: Yup
        .object()
        .required('Producto es requerido'),
      serie_lote: Yup
        .string()
        .required('Serie o lote es requerido'),
      cantidad: Yup
        .number()
        .required('Cantidad es requerida').positive('Debe ser un número positivo'),
      fecha_vencimiento: Yup
        .date()
        .required('Fecha de vencimiento es requerida'),
    })
  )
});

const initialValues = {
  tipo_adquisicion: null,
  fecha_recepcion: '',
  transportista: null,
  ot: '',
  numero_bultos: '',
  tipo_documento: null,
  numero_oc: '',
  proveedor: null,
  insumos: [
    {
      producto: null,
      serie_lote: '',
      cantidad: '',
      fecha_vencimiento: '',
    },
  ],
  observacion: '',
};

const Index = () => {
  const classes = useStyles();
  const MySwal = withReactContent(Swal);

  const [selTransportistas, setSelTransportistas] = useState([]);
  const [selProveedores, setSelProveedores] = useState([]);
  const [selProductos, setSelProductos] = useState([]);

  const selTipo = [
    { id: 1, name: 'CENABAST (intermediación)' },
    { id: 2, name: 'Compra' },
  ]

  const selDocumento = [
    { id: 1, name: 'Factura' },
    { id: 2, name: 'Guía' },
  ]

  const fetchTransportistas = async () => {
    try {
      const res = await api.getTransportistas();
      setSelTransportistas(res.data);
    } catch (err) {
      console.log(err);
    }
  };

  const fetchProveedores = async () => {
    try {
      const res = await api.getProveedores();
      setSelProveedores(res.data);
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

  useEffect(() => {
    fetchTransportistas();
    fetchProveedores();
    fetchProductos();
  }, []);

  return (
    <PageContainer>
      <Formik
        initialValues={initialValues}
        validationSchema={FORM_VALIDATION}
        onSubmit={(values, { resetForm }) => {
          const sentData = {
            'tipo_adquisicion_id': values.tipo_adquisicion?.id,
            'fecha_recepcion': values.fecha_recepcion,
            'transportista_id': values.transportista?.id,
            'numero_bultos': values.numero_bultos,
            'ot': values.ot,
            'tipo_documento_id': values.tipo_documento?.id,
            'numero_oc': values.numero_oc,
            'proveedor_id': values.proveedor?.id,
            'observacion': values.observacion,
            'insumos': values.insumos,
          }
          api.storeAdquisiciones(sentData)
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
              <CmtCardHeader title="Via Adquisicion" />
              <CmtCardContent>
                <Grid container spacing={3}>
                  <Grid item xs={6}>
                    <Select
                      name="tipo_adquisicion"
                      label="Via Adquisicion del Insumo"
                      options={selTipo}
                      getOptionLabel={(option) => option.name || ''}
                      getOptionSelected={(option, value) => option.id === value.id || ''}
                    />
                  </Grid>
                  <Grid item xs={6}>
                    <DateTime
                      name="fecha_recepcion"
                      label="Fecha de Recepción"
                    />
                  </Grid>
                </Grid>
              </CmtCardContent>
            </CmtCard>

            <br />

            <CmtCard>
              <CmtCardHeader title="Transportista" />
              <CmtCardContent>
                <Grid container spacing={3}>
                  <Grid item xs={4}>
                    <Select
                      name="transportista"
                      label="Transportista"
                      options={selTransportistas}
                      getOptionLabel={(option) => option.name || ''}
                      getOptionSelected={(option, value) => option.id === value.id || ''}
                    />
                  </Grid>
                  <Grid item xs={4}>
                    <TextField 
                      name="ot" 
                      label="OT" 
                    />
                  </Grid>
                  <Grid item xs={4}>
                    <TextField 
                      name="numero_bultos" 
                      label="Número de Bultos" 
                      type="number" 
                    />
                  </Grid>
                </Grid>
              </CmtCardContent>
            </CmtCard>

            <br />

            <CmtCard>
              <CmtCardHeader title="Documento" />
              <CmtCardContent>
                <Grid container spacing={3}>
                  <Grid item xs={4}>
                    <Select
                      name="tipo_documento"
                      label="Tipo Documento"
                      options={selDocumento}
                      getOptionLabel={(option) => option.name || ''}
                      getOptionSelected={(option, value) => option.id === value.id || ''}
                    />
                  </Grid>
                  <Grid item xs={4}>
                    <TextField 
                      name="numero_oc" 
                      label="Número de OC" 
                      type="number" 
                    />
                  </Grid>
                  <Grid item xs={4}>
                    <Select
                      name="proveedor"
                      label="Proveedor"
                      options={selProveedores}
                      getOptionLabel={(option) => `${option.rut} - ${option.name}` || ''}
                      getOptionSelected={(option, value) => option.id === value.id || ''}
                    />
                  </Grid>
                </Grid>
              </CmtCardContent>
            </CmtCard>

            <br />

            <CmtCard>
              <CmtCardHeader title="Insumos" />
              <CmtCardContent>
                <FieldArray name="insumos">
                  {({ push, remove }) => (
                    <>
                      {values.insumos.map((_, index) => (
                        <Grid container spacing={3} key={index}>
                          <Grid item xs={6}>
                            <Select
                              name={`insumos.${index}.producto`}
                              label="Producto"
                              options={selProductos}
                              getOptionLabel={(option) => `${option.id} - ${option.name}` || ''}
                              getOptionSelected={(option, value) => option.id === value.id || ''}
                            />
                          </Grid>
                          <Grid item xs={6}>
                            <TextField 
                              name={`insumos.${index}.serie_lote`} 
                              label="Serie o Lote" />
                          </Grid>
                          <Grid item xs={6}>
                            <TextField 
                              name={`insumos.${index}.cantidad`} 
                              label="Cantidad" 
                              type="number"
                            />
                          </Grid>
                          <Grid item xs={6}>
                            <DateTime 
                              name={`insumos.${index}.fecha_vencimiento`} 
                              label="Fecha de Vencimiento"
                            />
                          </Grid>
                          {/* <Grid item xs={12}>
                            <IconButton
                              color="secondary"
                              onClick={() => remove(index)}
                            >
                              <DeleteIcon />
                            </IconButton>
                          </Grid> */}
                          {values.insumos.length > 1 && (
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
                      ))}
                      <br/>
                        <IconButton
                          color="primary"
                          onClick={() => push({ producto: null, serie_lote: '', cantidad: '', fecha_vencimiento: '' })}
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
                <Grid container spacing={3}>
                  <Grid item xs={12}>
                    <TextField 
                      name="observacion" 
                      label="Observación" 
                      fullWidth
                      multiline
                      minRows={4}
                    />
                  </Grid>
                </Grid>
              </CmtCardContent>
            </CmtCard>

            <br />

            <CmtCard>
              <CmtCardContent>
                <Grid container spacing={3}>
                  <Grid item xs={6}>
                    <Button
                      className={classes.button}
                      color="primary"
                      variant="contained"
                      fullWidth
                      startIcon={<HighlightOffIcon />}
                      onClick={() => {
                        resetForm({ values: initialValues });
                      }}
                      size="large"
                    >
                      Limpiar Formulario
                    </Button>
                  </Grid>
                  <Grid item xs={6}>
                    <Button className={classes.botonVerde} variant="contained" fullWidth type="submit" startIcon={<SaveIcon />} size="large">
                      Guardar
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
