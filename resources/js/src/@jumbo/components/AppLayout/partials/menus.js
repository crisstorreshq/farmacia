import React from 'react';
import { PostAdd, Group, CloudDownload, AddBox, Assessment, AddShoppingCart, DateRange, List, PeopleOutline } from '@material-ui/icons';
import IntlMessages from '../../../utils/IntlMessages';
import api from './../../../../helpers/api'

//este es!!
const sidebarNavs = [
  {
    name: "Bodega de Farmacia",
    type: 'section',
    servicio: 57,
    children: [
      {
        name: 'Registro de Vencimiento',
        type: 'item',
        icon: <PostAdd />,
        link: '/reg_venc',
        rol: [1, 2]
      },
      // {
      //   name: 'Paciente Ingresados',
      //   type: 'item',
      //   icon: <Group />,
      //   link: '/allMedFisica',
      //   rol: [1, 2]
      // },
      // {
      //   name: 'Reporte',
      //   type: 'item',
      //   icon: <CloudDownload />,
      //   link: '/exportMedFisica',
      //   rol: [1, 2]
      // },
      // {
      //   name: 'REM BSB17',
      //   type: 'item',
      //   icon: <Assessment />,
      //   link: '/exportBsb17',
      //   rol: [1]
      // },
      // {
      //   name: 'REM A28',
      //   type: 'item',
      //   icon: <Assessment />,
      //   link: '/exportA28',
      //   rol: [1]
      // },
    ],
  }
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
