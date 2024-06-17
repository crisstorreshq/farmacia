import React from 'react';
import { Routes, Route } from "react-router-dom";
import SamplePage from './Pages/SamplePage';
import Error404 from './Pages/404';

import Vencimiento from './Pages/Vencimiento';

import RutasProtegidas from '../helpers/RutasProtegidas';

const Rutas = () => {

  return (
    <React.Fragment>
      <Routes>
        {/* home  */}
        <Route path="/home" element={<SamplePage />} />

        {/* Medicina Fisica */}
        <Route element={<RutasProtegidas idServicio={57}/>}>
          <Route path="/reg_venc" element={<Vencimiento />} />
        </Route>

        {/* 404 */}
        <Route path="*" element={<Error404 />} />

      </Routes>
    </React.Fragment>
  );
};

export default Rutas;
