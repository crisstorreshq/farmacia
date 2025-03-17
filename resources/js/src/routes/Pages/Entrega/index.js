import React, { useState, useEffect } from 'react';
import { Formik, Form, FieldArray } from 'formik';

import * as Yup from 'yup';

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

import TextField from './../../../Material/TextField';
import Select from './../../../Material/Select';
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
    fecha_recepcion: Yup
        .date()
        .required('Fecha de recepción es requerida'),
    numero_factura: Yup
        .string()
        .required('Número de factura es requerido'),
    numero_bultos: Yup
        .number()
        .required('Número de bultos es requerido')
        .positive('Debe ser un número positivo'),
    items: Yup.array().of(
        Yup.object().shape({
        cantidad: Yup
            .number()
            .required('Cantidad es requerida')
            .positive('Debe ser un número positivo'),
        unidad: Yup
            .object()
            .required('Unidad es requerida'),
        insumo: Yup
            .object()
            .required('Insumo es requerido'),
        laboratorio: Yup
            .object()
            .required('Laboratorio es requerido'),
        precio_unitario: Yup
            .number()
            .required('Precio unitario con IVA es requerido')
            .positive('Debe ser un número positivo'),
        precio_total: Yup
            .number()
            .required('Precio total con IVA es requerido')
            .positive('Debe ser un número positivo'),
        })
    ),
    tens_despacha: Yup
        .object()
        .required('TENS despacha es requerido'),
});

const initialValues = {
    fecha_recepcion: null,
    fecha_solicitud: null,
    numero_factura: '',
    numero_bultos: '',
    items: [
        {
            cantidad: '',
            unidad: null,
            insumo: null,
            laboratorio: null,
            precio_unitario: '',
            precio_total: '',
        },
    ],
    tens_despacha: null,
    tens_recibe: '',
};

const Index = () => {
    const classes = useStyles();

    const [selProductos, setSelProductos] = useState([]);
    const selUnidades = [
        { id: 1, name: 'Unidad' },
        { id: 2, name: 'Caja' },
    ];

    const selLaboratorios = [
        {id: 1, name: "AMILAB"},
        {id: 2, name: "ARQUIMED"},
        {id: 3, name: "BIOCANT"},
        {id: 4, name: "BIOMERIEDUX"},
        {id: 5, name: "CARIBEAN PHARMA"},
        {id: 6, name: "FARMALATINA"},
        {id: 7, name: "GALENICA"},
        {id: 8, name: "GRUPO BIOS-COAGULACION"},
        {id: 9, name: "INMUNODIAGNOSTICO"},
        {id: 10, name: "MEDICA-TEC"},
        {id: 11, name: "NIPRO"},
        {id: 12, name: "PROLAB"},
        {id: 13, name: "PV EQUIP"},
        {id: 14, name: "QUORUX"},
        {id: 15, name: "RE-MED"},
        {id: 16, name: "TECNIGEN"},
        {id: 17, name: "VALTEK"}
    ];

    const selTENS = [
        { id: 1, name: 'TENS 1' },
        { id: 2, name: 'TENS 2' },
        { id: 3, name: 'TENS 3' },
    ];

  const fetchProductos = async () => {
        try {
            const res = await api.getProductos();
            setSelProductos(res.data);
        } catch (err) {
            console.log(err);
        }
    };

    useEffect(() => {
        fetchProductos();
    }, []);

    return (
        <PageContainer>
            <Formik
                initialValues={initialValues}
                validationSchema={FORM_VALIDATION}
                onSubmit={(values) => {
                console.log(values);
                }}
            >
                {({ values, resetForm }) => (
                <Form>
                    <CmtCard>
                        <CmtCardHeader title="Recepción" />
                        <CmtCardContent>
                            <Grid container spacing={3}>
                                <Grid item xs={3}>
                                    <DateTime 
                                    name="fecha_recepcion" 
                                    label="Fecha de Recepción" 
                                    />
                                </Grid>
                                <Grid item xs={3}>
                                    <DateTime 
                                    name="fecha_solicitud" 
                                    label="Fecha Solicitud" 
                                    />
                                </Grid>
                                <Grid item xs={3}>
                                    <TextField 
                                    name="numero_factura" 
                                    label="Número de Factura" 
                                    />
                                </Grid>
                                <Grid item xs={3}>
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
                        <CmtCardHeader title="Items" />
                        <CmtCardContent>
                            <FieldArray name="items">
                            {({ push, remove }) => (
                                <>
                                {values.items.map((_, index) => (
                                    <Grid container spacing={3} key={index}>
                                        <Grid item xs={1}>
                                            <TextField 
                                                name={`items.${index}.cantidad`} 
                                                label="Cantidad" 
                                                type="number" 
                                            />
                                        </Grid>
                                        <Grid item xs={2}>
                                            <Select
                                                name={`items.${index}.unidad`}
                                                label="Unidad"
                                                options={selUnidades}
                                                getOptionLabel={(option) => option.name || ''}
                                                getOptionSelected={(option, value) => option.id === value.id || ''}
                                            />
                                        </Grid>
                                        <Grid item xs={3}>
                                            <Select
                                                name={`items.${index}.insumo`}
                                                label="Insumo"
                                                options={selProductos}
                                                getOptionLabel={(option) => option.name || ''}
                                                getOptionSelected={(option, value) => option.id === value.id || ''}
                                            />
                                        </Grid>
                                        <Grid item xs={2}>
                                            <Select
                                                name={`items.${index}.laboratorio`}
                                                label="Laboratorio"
                                                options={selLaboratorios}
                                                getOptionLabel={(option) => option.name || ''}
                                                getOptionSelected={(option, value) => option.id === value.id || ''}
                                            />
                                        </Grid>
                                        <Grid item xs={2}>
                                            <TextField 
                                                name={`items.${index}.precio_unitario`} 
                                                label="Precio Unitario con IVA" 
                                                type="number" 
                                            />
                                        </Grid>
                                        <Grid item xs={2}>
                                            <TextField 
                                                name={`items.${index}.precio_total`} 
                                                label="Precio Total con IVA" 
                                                type="number" 
                                            />
                                        </Grid>
                                        <Grid item xs={12}>
                                            {values.items.length > 1 && (
                                                <IconButton
                                                    color="secondary"
                                                    onClick={() => remove(index)}
                                                >
                                                    <DeleteIcon />
                                                </IconButton>
                                            )}
                                        </Grid>
                                    </Grid>
                                ))}
                                <IconButton
                                    color="primary"
                                    onClick={() => push({ cantidad: '', unidad: null, insumo: null, laboratorio: null, precio_unitario: '', precio_total: '' })}
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
                        <CmtCardHeader title="Despacho" />
                        <CmtCardContent>
                            <Grid container spacing={3}>
                                <Grid item xs={6}>
                                    <Select
                                    name="tens_despacha"
                                    label="TENS Despacha"
                                    options={selTENS}
                                    getOptionLabel={(option) => option.name || ''}
                                    getOptionSelected={(option, value) => option.id === value.id || ''}
                                    />
                                </Grid>
                                <Grid item xs={6}>
                                    <TextField 
                                    name="tens_recibe" 
                                    label="TENS Recibe" 
                                    />
                                </Grid>
                            </Grid>
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
                                        onClick={() => resetForm({ values: initialValues })}
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
                                        Guardar Recepción
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