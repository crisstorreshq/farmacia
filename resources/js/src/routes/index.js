import React from 'react';
import { Routes, Route } from "react-router-dom";
import SamplePage from './Pages/SamplePage';
import Error404 from './Pages/404';

import RutasProtegidas from '../helpers/RutasProtegidas';

const Rutas = () => {

  return (
    <React.Fragment>
      <Routes>
        {/* home  */}
        <Route path="/home" element={<SamplePage />} />

        {/* Medicina Fisica
        <Route element={<RutasProtegidas idServicio={46}/>}>
          <Route path="/addMedFisica" element={<PacientesMedFisica />} />
          <Route path="/allMedFisica" element={<AllMedFisica />} />
          <Route path="/exportMedFisica" element={<ExportMedFisica />} />
          <Route path="/exportBsb17" element={<ExportBsb17 />} />
          <Route path="/exportA28" element={<ExportA28 />} />
        </Route> */}

        {/* 404 */}
        <Route path="*" element={<Error404 />} />

      </Routes>
    </React.Fragment>
  );
};

export default Rutas;
