import React from 'react';
import { PostAdd, Group, CloudDownload, AddBox, Assessment, AddShoppingCart, DateRange, List, PeopleOutline } from '@material-ui/icons';
import IntlMessages from '../../../utils/IntlMessages';
import api from './../../../../helpers/api'

//este es!!
const sidebarNavs = [
  {
    name: "Medicina Física",
    type: 'section',
    servicio: 46,
    children: [
      {
        name: 'Agregar Paciente',
        type: 'item',
        icon: <PostAdd />,
        link: '/addMedFisica',
        rol: [1, 2]
      },
      {
        name: 'Paciente Ingresados',
        type: 'item',
        icon: <Group />,
        link: '/allMedFisica',
        rol: [1, 2]
      },
      {
        name: 'Reporte',
        type: 'item',
        icon: <CloudDownload />,
        link: '/exportMedFisica',
        rol: [1, 2]
      },
      {
        name: 'REM BSB17',
        type: 'item',
        icon: <Assessment />,
        link: '/exportBsb17',
        rol: [1]
      },
      {
        name: 'REM A28',
        type: 'item',
        icon: <Assessment />,
        link: '/exportA28',
        rol: [1]
      },
    ],
  },
  {
    name: "UMT",
    type: 'section',
    servicio: 55,
    children: [
      {
        name: 'Agregar Prestación',
        type: 'item',
        icon: <PostAdd />,
        link: '/addUMT',
      },
      {
        name: 'Prestación Ingresados',
        type: 'item',
        icon: <Group />,
        link: '/allUMT',
      },
      {
        name: 'Reporte',
        type: 'item',
        icon: <CloudDownload />,
        link: '/exportUMT',
      },
    ],
  },
  {
    name: "Imagenología",
    type: 'section',
    servicio: 56,
    children: [
      {
        name: 'Agregar Prestación',
        type: 'item',
        icon: <PostAdd />,
        link: '/addRX',
      },
      {
        name: 'Prestaciones Ingresadas',
        type: 'item',
        icon: <Group />,
        link: '/allRX',
      },
      {
        name: 'Compras de Servicio',
        type: 'item',
        icon: <AddShoppingCart />,
        link: '/compraServicio',
      },
      {
        name: 'Reporte REM',
        type: 'item',
        icon: <CloudDownload />,
        link: '/exportRX',
      },
      {
        name: 'Reporte Prestaciones',
        type: 'item',
        icon: <Assessment />,
        link: '/todoRx',
      },
    ],
  },

  {
    name: "Patología",
    type: 'section',
    servicio: 39,
    children: [
      {
        name: 'Agregar Prestación',
        type: 'item',
        icon: <PostAdd />,
        link: '/addPatologia',
      },
      {
        name: 'Prestaciones Ingresadas',
        type: 'item',
        icon: <Group />,
        link: '/allPatologia',
      },
      {
        name: 'Reporte',
        type: 'item',
        icon: <CloudDownload />,
        link: '/exportPatologia',
      },
    ],
  },
  
  {
    name: "Ayuda",
    type: 'section',
    servicio: 14,
    children: [
      {
        name: 'Agregar Especialidad',
        type: 'item',
        icon: <AddBox />,
        link: '/addEspec',
      },
      {
        name: 'Duplicidad de Fichas',
        type: 'item',
        icon: <PeopleOutline />,
        link: '/dupFichas',
      },
    ],
  },

  {
    name: "Lista Espera",
    type: 'section',
    servicio: 19,
    children: [
      {
        name: 'Policlínicos',
        type: 'item',
        icon: <DateRange />,
        link: '/lePoli',
      },
      {
        name: 'Vista Mensual',
        type: 'item',
        icon: <List />,
        link: '/leMes',
      },
    ],
  },
];

let servicioFiltado = []

function filtrarPorServicio(servicio) {
  const resultado = sidebarNavs.filter(item => item.servicio == servicio);
  return resultado;
}

function filtrarPorRol(array, valorRol) {
  const resultado = array.reduce((acc, item) => {
    const childrenFiltrados = item.children.filter(child => child.rol.includes(valorRol));
    if (childrenFiltrados.length > 0) {
      acc.push({ ...item, children: childrenFiltrados });
    }
    return acc;
  }, []);

  return resultado;
}

api.getAuth()
  .then(res => {
    let rol = res.data.sistemas.find(data => data.id === 8)
    let rolUser = parseInt(rol.pivot.role_id, 10)
    let unidad = res.data.perfil?.id_servicio
    switch (unidad) {
      case 14:
        servicioFiltado = sidebarNavs
        break;
      
      case 46:
        let menu = filtrarPorServicio(unidad)
        servicioFiltado = filtrarPorRol(menu, rolUser)
        break;

      default:
        servicioFiltado = filtrarPorServicio(unidad)
        break;
    }
  })

export { servicioFiltado as sidebarNavs }

//estos no

export const horizontalDefaultNavs = [
  {
    name: <IntlMessages id={'sidebar.main'} />,
    type: 'collapse',
    children: [
      {
        name: <IntlMessages id={'pages.samplePage'} />,
        type: 'item',
        icon: <PostAdd />,
        link: '/sample-page',
      },
    ],
  },
];

export const minimalHorizontalMenus = [
  {
    name: <IntlMessages id={'sidebar.main'} />,
    type: 'collapse',
    children: [
      {
        name: <IntlMessages id={'pages.samplePage'} />,
        type: 'item',
        icon: <PostAdd />,
        link: '/sample-page',
      },
    ],
  },
];
