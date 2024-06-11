import React, { useEffect, useState } from "react";
import "./styles.css";
import { PieChart, Pie, Cell, ResponsiveContainer } from "recharts";

import apiChart from "../helpers/apiChart";

const COLORS = ["#0088FE", "#FFBB28"];

const RADIAN = Math.PI / 180;

const renderCustomizedLabel = ({ cx, cy, midAngle, innerRadius, outerRadius, percent, index }) => {
  const radius = innerRadius + (outerRadius - innerRadius) * 0.5;
  const x = cx + radius * Math.cos(-midAngle * RADIAN);
  const y = cy + radius * Math.sin(-midAngle * RADIAN);

  return (
    <text
      x={x}
      y={y}
      fill="white"
      textAnchor={x > cx ? "start" : "end"}
      dominantBaseline="central"
    >
      {`${(percent * 100).toFixed(0)}%`}
    </text>
  );
};

export default function App() {
  
  const [genero, setGenero] = useState([])

  const fetchGenero = () => {
    apiChart.getGeneroMF()
      .then(res => {
        sessionStorage.setItem("genero", JSON.stringify(res.data));
        setGenero(res.data)
      })
      .catch(err => console.log(err))
  }

  useEffect(()=>{
    const generoStorage = sessionStorage.getItem("genero")
    generoStorage === null ?
      fetchGenero() :
      setGenero(JSON.parse(generoStorage))
  }, [])

  return (
    <div style={{
        width: "100%",
        height: "300px",
        display: "flex",
        flexWrap: "wrap",
        alignContent: "center"
      }}>
        <ResponsiveContainer>
            <PieChart>
            <Pie
                data={genero}
                cx={200}
                cy={200}
                labelLine={true}
                label={renderCustomizedLabel}
                outerRadius={80}
                fill="#8884d8"
                dataKey="cant"
            >
                {genero.map((entry, index) => (
                  <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} > <text> {entry.name} </text> </Cell>
                ))}
            </Pie>
            </PieChart>
        </ResponsiveContainer>
    </div>
  );
}
