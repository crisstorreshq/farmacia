import React, { useEffect, useState } from "react";
import "./styles.css";
import {
  BarChart,
  Bar,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  Legend,
  ResponsiveContainer
} from "recharts";

import apiChart from './../helpers/apiChart'

const AreaChartConnectNulls = () =>  {

  const [totalesMF, setTotalesMf] = useState([])

  const fetchData = () => {
    apiChart.getChartMF()
    .then(res => {
      sessionStorage.setItem("sessionTotales", JSON.stringify(res.data));
      setTotalesMf(res.data)
    })
    .catch(err => console.log(err))
  }

  useEffect(() => {
    const totalesStorage = sessionStorage.getItem("sessionTotales")
      totalesStorage === null ?
        fetchData() :
        setTotalesMf(JSON.parse(totalesStorage))
  }, [])

  return (
    <ResponsiveContainer width={'100%'} height={300}>
      <BarChart data={totalesMF} margin={{ top: 5, right: 30, left: 20, bottom: 5 }}>
        <CartesianGrid strokeDasharray="3 3" />
        <XAxis dataKey="name" />
        <YAxis />
        <Tooltip />
        <Legend />
        <Bar dataKey="value" fill="#8884d8" name="Cantidad de Prestaciones"/>
      </BarChart>
    </ResponsiveContainer>
    
  );
}

export default AreaChartConnectNulls