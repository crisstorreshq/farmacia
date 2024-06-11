<table style="width: 100%; border: solid 1px">
    <thead>
        <tr>
            <th rowspan="3">-</th>
            <th rowspan="3">Total</th>
            <th colspan="17">Por Edad (En años)</th>
            <th colspan="3">Tipo Atención</th>
        </tr>
        <tr>
            <th rowspan="2">0-4</th>
            <th rowspan="2">5-9</th>
            <th rowspan="2">10-14</th>
            <th rowspan="2">15-19</th>
            <th rowspan="2">20-24</th>
            <th rowspan="2">25-29</th>
            <th rowspan="2">30-34</th>
            <th rowspan="2">35-39</th>
            <th rowspan="2">40-44</th>
            <th rowspan="2">45-49</th>
            <th rowspan="2">50-54</th>
            <th rowspan="2">55-59</th>
            <th rowspan="2">60-64</th>
            <th rowspan="2">65-69</th>
            <th rowspan="2">70-74</th>
            <th rowspan="2">75-79</th>
            <th rowspan="2">80-más</th>
            <th rowspan="2">Abierta</th>
            <th colspan="2">Cerrada</th>
        </tr>
        <tr>
            <th>UPC</th>
            <th>Cuidados Medios y Básicos</th>
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <td>EGRESOS (TOTAL)</td>
            <td>
                {{ 
                    $data['egresoAlta']['total'] +
                    $data['egresoAbandono']['total'] +
                    $data['egresoFallecimiento']['total'] +
                    $data['egresoOtro']['total'] +
                    $data['egresoAcvAps']['total']
                }}
            </td>
            <td>
                {{ 
                    $data['egresoAlta']['0-3'] +
                    $data['egresoAbandono']['0-3'] +
                    $data['egresoFallecimiento']['0-3'] +
                    $data['egresoOtro']['0-3'] +
                    $data['egresoAcvAps']['0-3']
                }}
            </td>
            <td>
                {{ 
                    $data['egresoAlta']['5-9'] +
                    $data['egresoAbandono']['5-9'] +
                    $data['egresoFallecimiento']['5-9'] +
                    $data['egresoOtro']['5-9'] +
                    $data['egresoAcvAps']['5-9']
                }}
            </td>
            <td>
                {{ 
                    $data['egresoAlta']['10-14'] +
                    $data['egresoAbandono']['10-14'] +
                    $data['egresoFallecimiento']['10-14'] +
                    $data['egresoOtro']['10-14'] +
                    $data['egresoAcvAps']['10-14']
                }}
            </td>
            <td>
                {{ 
                    $data['egresoAlta']['15-19'] +
                    $data['egresoAbandono']['15-19'] +
                    $data['egresoFallecimiento']['15-19'] +
                    $data['egresoOtro']['15-19'] +
                    $data['egresoAcvAps']['15-19']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['20-24'] +
                    $data['egresoAbandono']['20-24'] +
                    $data['egresoFallecimiento']['20-24'] +
                    $data['egresoOtro']['20-24'] +
                    $data['egresoAcvAps']['20-24']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['25-29'] +
                    $data['egresoAbandono']['25-29'] +
                    $data['egresoFallecimiento']['25-29'] +
                    $data['egresoOtro']['25-29'] +
                    $data['egresoAcvAps']['25-29']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['30-34'] +
                    $data['egresoAbandono']['30-34'] +
                    $data['egresoFallecimiento']['30-34'] +
                    $data['egresoOtro']['30-34'] +
                    $data['egresoAcvAps']['30-34']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['35-39'] +
                    $data['egresoAbandono']['35-39'] +
                    $data['egresoFallecimiento']['35-39'] +
                    $data['egresoOtro']['35-39'] +
                    $data['egresoAcvAps']['35-39']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['40-44'] +
                    $data['egresoAbandono']['40-44'] +
                    $data['egresoFallecimiento']['40-44'] +
                    $data['egresoOtro']['40-44'] +
                    $data['egresoAcvAps']['40-44']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['45-49'] +
                    $data['egresoAbandono']['45-49'] +
                    $data['egresoFallecimiento']['45-49'] +
                    $data['egresoOtro']['45-49'] +
                    $data['egresoAcvAps']['45-49']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['50-54'] +
                    $data['egresoAbandono']['50-54'] +
                    $data['egresoFallecimiento']['50-54'] +
                    $data['egresoOtro']['50-54'] +
                    $data['egresoAcvAps']['50-54']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['55-59'] +
                    $data['egresoAbandono']['55-59'] +
                    $data['egresoFallecimiento']['55-59'] +
                    $data['egresoOtro']['55-59'] +
                    $data['egresoAcvAps']['55-59']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['60-64'] +
                    $data['egresoAbandono']['60-64'] +
                    $data['egresoFallecimiento']['60-64'] +
                    $data['egresoOtro']['60-64'] +
                    $data['egresoAcvAps']['60-64']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['65-69'] +
                    $data['egresoAbandono']['65-69'] +
                    $data['egresoFallecimiento']['65-69'] +
                    $data['egresoOtro']['65-69'] +
                    $data['egresoAcvAps']['65-69']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['70-74'] +
                    $data['egresoAbandono']['70-74'] +
                    $data['egresoFallecimiento']['70-74'] +
                    $data['egresoOtro']['70-74'] +
                    $data['egresoAcvAps']['70-74']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['75-79'] +
                    $data['egresoAbandono']['75-79'] +
                    $data['egresoFallecimiento']['75-79'] +
                    $data['egresoOtro']['75-79'] +
                    $data['egresoAcvAps']['75-79']
                }}
            </td>
            <td>
                {{
                    $data['egresoAlta']['80-max'] +
                    $data['egresoAbandono']['80-max'] +
                    $data['egresoFallecimiento']['80-max'] +
                    $data['egresoOtro']['80-max'] +
                    $data['egresoAcvAps']['80-max']
                }}
            </td>
            <td>
                {{
                    $data['egresoTipoAtencionAlta']['abierta'] +
                    $data['egresoTipoAtencionAbandono']['abierta'] +
                    $data['egresoTipoAtencionFallecimiento']['abierta'] +
                    $data['egresoTipoAtencionOtro']['abierta'] +
                    $data['egresoTipoAtencionAcvAps']['abierta']
                }}
            </td>
            <td>
                {{
                    $data['egresoTipoAtencionAlta']['upc'] +
                    $data['egresoTipoAtencionAbandono']['upc'] +
                    $data['egresoTipoAtencionFallecimiento']['upc'] +
                    $data['egresoTipoAtencionOtro']['upc'] +
                    $data['egresoTipoAtencionAcvAps']['upc']
                }}
            </td>
            <td>
                {{
                    $data['egresoTipoAtencionAlta']['cerrado_basico_medio'] +
                    $data['egresoTipoAtencionAbandono']['cerrado_basico_medio'] +
                    $data['egresoTipoAtencionFallecimiento']['cerrado_basico_medio'] +
                    $data['egresoTipoAtencionOtro']['cerrado_basico_medio'] +
                    $data['egresoTipoAtencionAcvAps']['cerrado_basico_medio']
                }}
            </td>
        </tr>

        <tr>
            <td>EGRESOS POR ALTA</td>
            <td>{{ $data['egresoAlta']['total'] }}</td>
            <td>{{ $data['egresoAlta']['0-3'] }}</td>
            <td>{{ $data['egresoAlta']['5-9'] }}</td>
            <td>{{ $data['egresoAlta']['10-14'] }}</td>
            <td>{{ $data['egresoAlta']['15-19'] }}</td>
            <td>{{ $data['egresoAlta']['20-24'] }}</td>
            <td>{{ $data['egresoAlta']['25-29'] }}</td>
            <td>{{ $data['egresoAlta']['30-34'] }}</td>
            <td>{{ $data['egresoAlta']['35-39'] }}</td>
            <td>{{ $data['egresoAlta']['40-44'] }}</td>
            <td>{{ $data['egresoAlta']['45-49'] }}</td>
            <td>{{ $data['egresoAlta']['50-54'] }}</td>
            <td>{{ $data['egresoAlta']['55-59'] }}</td>
            <td>{{ $data['egresoAlta']['60-64'] }}</td>
            <td>{{ $data['egresoAlta']['65-69'] }}</td>
            <td>{{ $data['egresoAlta']['70-74'] }}</td>
            <td>{{ $data['egresoAlta']['75-79'] }}</td>
            <td>{{ $data['egresoAlta']['80-max'] }}</td>
            <td>{{ $data['egresoTipoAtencionAlta']['abierta'] }}</td>
            <td>{{ $data['egresoTipoAtencionAlta']['upc'] }}</td>
            <td>{{ $data['egresoTipoAtencionAlta']['cerrado_basico_medio'] }}</td>

        </tr>

        <tr>
            <td>EGRESOS POR ABANDONO</td>
            <td>{{ $data['egresoAbandono']['total'] }}</td>
            <td>{{ $data['egresoAbandono']['0-3'] }}</td>
            <td>{{ $data['egresoAbandono']['5-9'] }}</td>
            <td>{{ $data['egresoAbandono']['10-14'] }}</td>
            <td>{{ $data['egresoAbandono']['15-19'] }}</td>
            <td>{{ $data['egresoAbandono']['20-24'] }}</td>
            <td>{{ $data['egresoAbandono']['25-29'] }}</td>
            <td>{{ $data['egresoAbandono']['30-34'] }}</td>
            <td>{{ $data['egresoAbandono']['35-39'] }}</td>
            <td>{{ $data['egresoAbandono']['40-44'] }}</td>
            <td>{{ $data['egresoAbandono']['45-49'] }}</td>
            <td>{{ $data['egresoAbandono']['50-54'] }}</td>
            <td>{{ $data['egresoAbandono']['55-59'] }}</td>
            <td>{{ $data['egresoAbandono']['60-64'] }}</td>
            <td>{{ $data['egresoAbandono']['65-69'] }}</td>
            <td>{{ $data['egresoAbandono']['70-74'] }}</td>
            <td>{{ $data['egresoAbandono']['75-79'] }}</td>
            <td>{{ $data['egresoAbandono']['80-max'] }}</td>
            <td>{{ $data['egresoTipoAtencionAbandono']['abierta'] }}</td>
            <td>{{ $data['egresoTipoAtencionAbandono']['upc'] }}</td>
            <td>{{ $data['egresoTipoAtencionAbandono']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>EGRESOS POR FALLECIMIENTO</td>
            <td>{{ $data['egresoFallecimiento']['total'] }}</td>
            <td>{{ $data['egresoFallecimiento']['0-3'] }}</td>
            <td>{{ $data['egresoFallecimiento']['5-9'] }}</td>
            <td>{{ $data['egresoFallecimiento']['10-14'] }}</td>
            <td>{{ $data['egresoFallecimiento']['15-19'] }}</td>
            <td>{{ $data['egresoFallecimiento']['20-24'] }}</td>
            <td>{{ $data['egresoFallecimiento']['25-29'] }}</td>
            <td>{{ $data['egresoFallecimiento']['30-34'] }}</td>
            <td>{{ $data['egresoFallecimiento']['35-39'] }}</td>
            <td>{{ $data['egresoFallecimiento']['40-44'] }}</td>
            <td>{{ $data['egresoFallecimiento']['45-49'] }}</td>
            <td>{{ $data['egresoFallecimiento']['50-54'] }}</td>
            <td>{{ $data['egresoFallecimiento']['55-59'] }}</td>
            <td>{{ $data['egresoFallecimiento']['60-64'] }}</td>
            <td>{{ $data['egresoFallecimiento']['65-69'] }}</td>
            <td>{{ $data['egresoFallecimiento']['70-74'] }}</td>
            <td>{{ $data['egresoFallecimiento']['75-79'] }}</td>
            <td>{{ $data['egresoFallecimiento']['80-max'] }}</td>
            <td>{{ $data['egresoTipoAtencionFallecimiento']['abierta'] }}</td>
            <td>{{ $data['egresoTipoAtencionFallecimiento']['upc'] }}</td>
            <td>{{ $data['egresoTipoAtencionFallecimiento']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>EGRESOS ACV REFERIDO A APS</td>
            <td>{{ $data['egresoAcvAps']['total'] }}</td>
            <td>{{ $data['egresoAcvAps']['0-3'] }}</td>
            <td>{{ $data['egresoAcvAps']['5-9'] }}</td>
            <td>{{ $data['egresoAcvAps']['10-14'] }}</td>
            <td>{{ $data['egresoAcvAps']['15-19'] }}</td>
            <td>{{ $data['egresoAcvAps']['20-24'] }}</td>
            <td>{{ $data['egresoAcvAps']['25-29'] }}</td>
            <td>{{ $data['egresoAcvAps']['30-34'] }}</td>
            <td>{{ $data['egresoAcvAps']['35-39'] }}</td>
            <td>{{ $data['egresoAcvAps']['40-44'] }}</td>
            <td>{{ $data['egresoAcvAps']['45-49'] }}</td>
            <td>{{ $data['egresoAcvAps']['50-54'] }}</td>
            <td>{{ $data['egresoAcvAps']['55-59'] }}</td>
            <td>{{ $data['egresoAcvAps']['60-64'] }}</td>
            <td>{{ $data['egresoAcvAps']['65-69'] }}</td>
            <td>{{ $data['egresoAcvAps']['70-74'] }}</td>
            <td>{{ $data['egresoAcvAps']['75-79'] }}</td>
            <td>{{ $data['egresoAcvAps']['80-max'] }}</td>
            <td>{{ $data['egresoTipoAtencionAcvAps']['abierta'] }}</td>
            <td>{{ $data['egresoTipoAtencionAcvAps']['upc'] }}</td>
            <td>{{ $data['egresoTipoAtencionAcvAps']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>OTROS</td>
            <td>{{ $data['egresoOtro']['total'] }}</td>
            <td>{{ $data['egresoOtro']['0-3'] }}</td>
            <td>{{ $data['egresoOtro']['5-9'] }}</td>
            <td>{{ $data['egresoOtro']['10-14'] }}</td>
            <td>{{ $data['egresoOtro']['15-19'] }}</td>
            <td>{{ $data['egresoOtro']['20-24'] }}</td>
            <td>{{ $data['egresoOtro']['25-29'] }}</td>
            <td>{{ $data['egresoOtro']['30-34'] }}</td>
            <td>{{ $data['egresoOtro']['35-39'] }}</td>
            <td>{{ $data['egresoOtro']['40-44'] }}</td>
            <td>{{ $data['egresoOtro']['45-49'] }}</td>
            <td>{{ $data['egresoOtro']['50-54'] }}</td>
            <td>{{ $data['egresoOtro']['55-59'] }}</td>
            <td>{{ $data['egresoOtro']['60-64'] }}</td>
            <td>{{ $data['egresoOtro']['65-69'] }}</td>
            <td>{{ $data['egresoOtro']['70-74'] }}</td>
            <td>{{ $data['egresoOtro']['75-79'] }}</td>
            <td>{{ $data['egresoOtro']['80-max'] }}</td>
            <td>{{ $data['egresoTipoAtencionOtro']['abierta'] }}</td>
            <td>{{ $data['egresoTipoAtencionOtro']['upc'] }}</td>
            <td>{{ $data['egresoTipoAtencionOtro']['cerrado_basico_medio'] }}</td>
        </tr>
    </tbody>
</table>

<table style="width: 100%; border: solid 1px">
    <thead>
        <tr>
            <th rowspan="3">SECCIÓN B.2: EVALUACIÓN INICIAL</th>
            <th rowspan="3">Total</th>
            <th colspan="17">Por Edad (En años)</th>
            <th colspan="5">Tipo Atención</th>
        </tr>
        <tr>
            <th rowspan="2">0-4</th>
            <th rowspan="2">5-9</th>
            <th rowspan="2">10-14</th>
            <th rowspan="2">15-19</th>
            <th rowspan="2">20-24</th>
            <th rowspan="2">25-29</th>
            <th rowspan="2">30-34</th>
            <th rowspan="2">35-39</th>
            <th rowspan="2">40-44</th>
            <th rowspan="2">45-49</th>
            <th rowspan="2">50-54</th>
            <th rowspan="2">55-59</th>
            <th rowspan="2">60-64</th>
            <th rowspan="2">65-69</th>
            <th rowspan="2">70-74</th>
            <th rowspan="2">75-79</th>
            <th rowspan="2">80-más</th>
            <th colspan="3">Abierta</th>
            <th colspan="2">Cerrada</th>
        </tr>
        <tr>
            <th>Presencial</th>
            <th>A Distancia</th>
            <th>Domiciliaria</th>
            <th>UPC</th>
            <th>Cuidados Medios y Básicos</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>KINESIÓLOGO/A</td>
            <td>{{ $data['evInicialKine']['total'] }}</td>
            <td>{{ $data['evInicialKine']['0-3'] }}</td>
            <td>{{ $data['evInicialKine']['5-9'] }}</td>
            <td>{{ $data['evInicialKine']['10-14'] }}</td>
            <td>{{ $data['evInicialKine']['15-19'] }}</td>
            <td>{{ $data['evInicialKine']['20-24'] }}</td>
            <td>{{ $data['evInicialKine']['25-29'] }}</td>
            <td>{{ $data['evInicialKine']['30-34'] }}</td>
            <td>{{ $data['evInicialKine']['35-39'] }}</td>
            <td>{{ $data['evInicialKine']['40-44'] }}</td>
            <td>{{ $data['evInicialKine']['45-49'] }}</td>
            <td>{{ $data['evInicialKine']['50-54'] }}</td>
            <td>{{ $data['evInicialKine']['55-59'] }}</td>
            <td>{{ $data['evInicialKine']['60-64'] }}</td>
            <td>{{ $data['evInicialKine']['65-69'] }}</td>
            <td>{{ $data['evInicialKine']['70-74'] }}</td>
            <td>{{ $data['evInicialKine']['75-79'] }}</td>
            <td>{{ $data['evInicialKine']['80-max'] }}</td>
            <td>{{ $data['evInicialKineTipoAtencion']['abierta'] }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $data['evInicialKineTipoAtencion']['upc'] }}</td>
            <td>{{ $data['evInicialKineTipoAtencion']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>TERAPEUTA OCUPACIONAL</td>
            <td>{{ $data['evInicialTO']['total'] }}</td>
            <td>{{ $data['evInicialTO']['0-3'] }}</td>
            <td>{{ $data['evInicialTO']['5-9'] }}</td>
            <td>{{ $data['evInicialTO']['10-14'] }}</td>
            <td>{{ $data['evInicialTO']['15-19'] }}</td>
            <td>{{ $data['evInicialTO']['20-24'] }}</td>
            <td>{{ $data['evInicialTO']['25-29'] }}</td>
            <td>{{ $data['evInicialTO']['30-34'] }}</td>
            <td>{{ $data['evInicialTO']['35-39'] }}</td>
            <td>{{ $data['evInicialTO']['40-44'] }}</td>
            <td>{{ $data['evInicialTO']['45-49'] }}</td>
            <td>{{ $data['evInicialTO']['50-54'] }}</td>
            <td>{{ $data['evInicialTO']['55-59'] }}</td>
            <td>{{ $data['evInicialTO']['60-64'] }}</td>
            <td>{{ $data['evInicialTO']['65-69'] }}</td>
            <td>{{ $data['evInicialTO']['70-74'] }}</td>
            <td>{{ $data['evInicialTO']['75-79'] }}</td>
            <td>{{ $data['evInicialTO']['80-max'] }}</td>
            <td>{{ $data['evInicialTOTipoAtencion']['abierta'] }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $data['evInicialTOTipoAtencion']['upc'] }}</td>
            <td>{{ $data['evInicialTOTipoAtencion']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>FONOAUDIÓLOGO/A</td>
            <td>{{ $data['evInicialFono']['total'] }}</td>
            <td>{{ $data['evInicialFono']['0-3'] }}</td>
            <td>{{ $data['evInicialFono']['5-9'] }}</td>
            <td>{{ $data['evInicialFono']['10-14'] }}</td>
            <td>{{ $data['evInicialFono']['15-19'] }}</td>
            <td>{{ $data['evInicialFono']['20-24'] }}</td>
            <td>{{ $data['evInicialFono']['25-29'] }}</td>
            <td>{{ $data['evInicialFono']['30-34'] }}</td>
            <td>{{ $data['evInicialFono']['35-39'] }}</td>
            <td>{{ $data['evInicialFono']['40-44'] }}</td>
            <td>{{ $data['evInicialFono']['45-49'] }}</td>
            <td>{{ $data['evInicialFono']['50-54'] }}</td>
            <td>{{ $data['evInicialFono']['55-59'] }}</td>
            <td>{{ $data['evInicialFono']['60-64'] }}</td>
            <td>{{ $data['evInicialFono']['65-69'] }}</td>
            <td>{{ $data['evInicialFono']['70-74'] }}</td>
            <td>{{ $data['evInicialFono']['75-79'] }}</td>
            <td>{{ $data['evInicialFono']['80-max'] }}</td>
            <td>{{ $data['evInicialFonoTipoAtencion']['abierta'] }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $data['evInicialFonoTipoAtencion']['upc'] }}</td>
            <td>{{ $data['evInicialFonoTipoAtencion']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>TOTAL</td>
            <td>
                {{
                    $data['evInicialKine']['total'] +
                    $data['evInicialTO']['total'] +
                    $data['evInicialFono']['total']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['0-3'] +
                    $data['evInicialTO']['0-3'] +
                    $data['evInicialFono']['0-3']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['5-9'] +
                    $data['evInicialTO']['5-9'] +
                    $data['evInicialFono']['5-9']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['10-14'] +
                    $data['evInicialTO']['10-14'] +
                    $data['evInicialFono']['10-14']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['15-19'] +
                    $data['evInicialTO']['15-19'] +
                    $data['evInicialFono']['15-19']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['20-24'] +
                    $data['evInicialTO']['20-24'] +
                    $data['evInicialFono']['20-24']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['25-29'] +
                    $data['evInicialTO']['25-29'] +
                    $data['evInicialFono']['25-29']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['30-34'] +
                    $data['evInicialTO']['30-34'] +
                    $data['evInicialFono']['30-34']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['35-39'] +
                    $data['evInicialTO']['35-39'] +
                    $data['evInicialFono']['35-39']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['40-44'] +
                    $data['evInicialTO']['40-44'] +
                    $data['evInicialFono']['40-44']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['45-49'] +
                    $data['evInicialTO']['45-49'] +
                    $data['evInicialFono']['45-49']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['50-54'] +
                    $data['evInicialTO']['50-54'] +
                    $data['evInicialFono']['50-54']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['55-59'] +
                    $data['evInicialTO']['55-59'] +
                    $data['evInicialFono']['55-59']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['60-64'] +
                    $data['evInicialTO']['60-64'] +
                    $data['evInicialFono']['60-64']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['65-69'] +
                    $data['evInicialTO']['65-69'] +
                    $data['evInicialFono']['65-69']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['70-74'] +
                    $data['evInicialTO']['70-74'] +
                    $data['evInicialFono']['70-74']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['75-79'] +
                    $data['evInicialTO']['75-79'] +
                    $data['evInicialFono']['75-79']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKine']['80-max'] +
                    $data['evInicialTO']['80-max'] +
                    $data['evInicialFono']['80-max']
                }}
            </td>
            <td>
                {{
                    $data['evInicialKineTipoAtencion']['abierta'] +
                    $data['evInicialTOTipoAtencion']['abierta'] +
                    $data['evInicialFonoTipoAtencion']['abierta'] 
                }}
            </td>

            <td>
                0
            </td>

            <td>
                0
            </td>

            <td>
                {{
                     $data['evInicialKineTipoAtencion']['upc'] +
                     $data['evInicialTOTipoAtencion']['upc'] +
                     $data['evInicialFonoTipoAtencion']['upc'] 
                }}
            </td>

            <td>
                {{
                     $data['evInicialKineTipoAtencion']['cerrado_basico_medio'] +
                     $data['evInicialTOTipoAtencion']['cerrado_basico_medio'] +
                     $data['evInicialFonoTipoAtencion']['cerrado_basico_medio'] 
                }}
            </td>


        </tr>

    </tbody>
</table>

<table style="width: 100%; border: solid 1px">
    <thead>
        <tr>
            <th rowspan="3">SECCIÓN B.3: EVALUACIÓN INTERMEDIA</th>
            <th rowspan="3">Total</th>
            <th colspan="17">Por Edad (En años)</th>
            <th colspan="5">Tipo Atención</th>
        </tr>
        <tr>
            <th rowspan="2">0-4</th>
            <th rowspan="2">5-9</th>
            <th rowspan="2">10-14</th>
            <th rowspan="2">15-19</th>
            <th rowspan="2">20-24</th>
            <th rowspan="2">25-29</th>
            <th rowspan="2">30-34</th>
            <th rowspan="2">35-39</th>
            <th rowspan="2">40-44</th>
            <th rowspan="2">45-49</th>
            <th rowspan="2">50-54</th>
            <th rowspan="2">55-59</th>
            <th rowspan="2">60-64</th>
            <th rowspan="2">65-69</th>
            <th rowspan="2">70-74</th>
            <th rowspan="2">75-79</th>
            <th rowspan="2">80-más</th>
            <th colspan="3">Abierta</th>
            <th colspan="2">Cerrada</th>
        </tr>
        <tr>
            <th>Presencial</th>
            <th>A Distancia</th>
            <th>Domiciliaria</th>
            <th>UPC</th>
            <th>Cuidados Medios y Básicos</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>KINESIÓLOGO/A</td>
            <td>{{ $data['evInterKine']['total'] }}</td>
            <td>{{ $data['evInterKine']['0-3'] }}</td>
            <td>{{ $data['evInterKine']['5-9'] }}</td>
            <td>{{ $data['evInterKine']['10-14'] }}</td>
            <td>{{ $data['evInterKine']['15-19'] }}</td>
            <td>{{ $data['evInterKine']['20-24'] }}</td>
            <td>{{ $data['evInterKine']['25-29'] }}</td>
            <td>{{ $data['evInterKine']['30-34'] }}</td>
            <td>{{ $data['evInterKine']['35-39'] }}</td>
            <td>{{ $data['evInterKine']['40-44'] }}</td>
            <td>{{ $data['evInterKine']['45-49'] }}</td>
            <td>{{ $data['evInterKine']['50-54'] }}</td>
            <td>{{ $data['evInterKine']['55-59'] }}</td>
            <td>{{ $data['evInterKine']['60-64'] }}</td>
            <td>{{ $data['evInterKine']['65-69'] }}</td>
            <td>{{ $data['evInterKine']['70-74'] }}</td>
            <td>{{ $data['evInterKine']['75-79'] }}</td>
            <td>{{ $data['evInterKine']['80-max'] }}</td>
            <td>{{ $data['evIntermediaKineTipoAtencion']['abierta'] }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $data['evIntermediaKineTipoAtencion']['upc'] }}</td>
            <td>{{ $data['evIntermediaKineTipoAtencion']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>TERAPEUTA OCUPACIONAL</td>
            <td>{{ $data['evInterTO']['total'] }}</td>
            <td>{{ $data['evInterTO']['0-3'] }}</td>
            <td>{{ $data['evInterTO']['5-9'] }}</td>
            <td>{{ $data['evInterTO']['10-14'] }}</td>
            <td>{{ $data['evInterTO']['15-19'] }}</td>
            <td>{{ $data['evInterTO']['20-24'] }}</td>
            <td>{{ $data['evInterTO']['25-29'] }}</td>
            <td>{{ $data['evInterTO']['30-34'] }}</td>
            <td>{{ $data['evInterTO']['35-39'] }}</td>
            <td>{{ $data['evInterTO']['40-44'] }}</td>
            <td>{{ $data['evInterTO']['45-49'] }}</td>
            <td>{{ $data['evInterTO']['50-54'] }}</td>
            <td>{{ $data['evInterTO']['55-59'] }}</td>
            <td>{{ $data['evInterTO']['60-64'] }}</td>
            <td>{{ $data['evInterTO']['65-69'] }}</td>
            <td>{{ $data['evInterTO']['70-74'] }}</td>
            <td>{{ $data['evInterTO']['75-79'] }}</td>
            <td>{{ $data['evInterTO']['80-max'] }}</td>
            <td>{{ $data['evIntermediaTOTipoAtencion']['abierta'] }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $data['evIntermediaTOTipoAtencion']['upc'] }}</td>
            <td>{{ $data['evIntermediaTOTipoAtencion']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>FONOAUDIÓLOGO/A</td>
            <td>{{ $data['evInterFono']['total'] }}</td>
            <td>{{ $data['evInterFono']['0-3'] }}</td>
            <td>{{ $data['evInterFono']['5-9'] }}</td>
            <td>{{ $data['evInterFono']['10-14'] }}</td>
            <td>{{ $data['evInterFono']['15-19'] }}</td>
            <td>{{ $data['evInterFono']['20-24'] }}</td>
            <td>{{ $data['evInterFono']['25-29'] }}</td>
            <td>{{ $data['evInterFono']['30-34'] }}</td>
            <td>{{ $data['evInterFono']['35-39'] }}</td>
            <td>{{ $data['evInterFono']['40-44'] }}</td>
            <td>{{ $data['evInterFono']['45-49'] }}</td>
            <td>{{ $data['evInterFono']['50-54'] }}</td>
            <td>{{ $data['evInterFono']['55-59'] }}</td>
            <td>{{ $data['evInterFono']['60-64'] }}</td>
            <td>{{ $data['evInterFono']['65-69'] }}</td>
            <td>{{ $data['evInterFono']['70-74'] }}</td>
            <td>{{ $data['evInterFono']['75-79'] }}</td>
            <td>{{ $data['evInterFono']['80-max'] }}</td>
            <td>{{ $data['evIntermediaFonoTipoAtencion']['abierta'] }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $data['evIntermediaFonoTipoAtencion']['upc'] }}</td>
            <td>{{ $data['evIntermediaFonoTipoAtencion']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>TOTAL</td>
            <td>
                {{
                    $data['evInterKine']['total'] +
                    $data['evInterTO']['total'] +
                    $data['evInterFono']['total']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['0-3'] +
                    $data['evInterTO']['0-3'] +
                    $data['evInterFono']['0-3']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['5-9'] +
                    $data['evInterTO']['5-9'] +
                    $data['evInterFono']['5-9']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['10-14'] +
                    $data['evInterTO']['10-14'] +
                    $data['evInterFono']['10-14']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['15-19'] +
                    $data['evInterTO']['15-19'] +
                    $data['evInterFono']['15-19']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['20-24'] +
                    $data['evInterTO']['20-24'] +
                    $data['evInterFono']['20-24']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['25-29'] +
                    $data['evInterTO']['25-29'] +
                    $data['evInterFono']['25-29']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['30-34'] +
                    $data['evInterTO']['30-34'] +
                    $data['evInterFono']['30-34']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['35-39'] +
                    $data['evInterTO']['35-39'] +
                    $data['evInterFono']['35-39']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['40-44'] +
                    $data['evInterTO']['40-44'] +
                    $data['evInterFono']['40-44']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['45-49'] +
                    $data['evInterTO']['45-49'] +
                    $data['evInterFono']['45-49']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['50-54'] +
                    $data['evInterTO']['50-54'] +
                    $data['evInterFono']['50-54']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['55-59'] +
                    $data['evInterTO']['55-59'] +
                    $data['evInterFono']['55-59']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['60-64'] +
                    $data['evInterTO']['60-64'] +
                    $data['evInterFono']['60-64']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['65-69'] +
                    $data['evInterTO']['65-69'] +
                    $data['evInterFono']['65-69']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['70-74'] +
                    $data['evInterTO']['70-74'] +
                    $data['evInterFono']['70-74']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['75-79'] +
                    $data['evInterTO']['75-79'] +
                    $data['evInterFono']['75-79']
                }}
            </td>
            <td>
                {{
                    $data['evInterKine']['80-max'] +
                    $data['evInterTO']['80-max'] +
                    $data['evInterFono']['80-max']
                }}
            </td>

            <td>
                {{
                    $data['evIntermediaKineTipoAtencion']['abierta'] +
                    $data['evIntermediaFonoTipoAtencion']['abierta'] +
                    $data['evIntermediaTOTipoAtencion']['abierta']
                }}
            </td>

            <td>0</td>
            <td>0</td>

            <td>
                {{
                    $data['evIntermediaKineTipoAtencion']['upc'] +
                    $data['evIntermediaFonoTipoAtencion']['upc'] +
                    $data['evIntermediaTOTipoAtencion']['upc']
                }}
            </td>

            <td>
                {{
                    $data['evIntermediaKineTipoAtencion']['cerrado_basico_medio'] +
                    $data['evIntermediaFonoTipoAtencion']['cerrado_basico_medio'] +
                    $data['evIntermediaTOTipoAtencion']['cerrado_basico_medio']
                }}
            </td>
        </tr>

    </tbody>
</table>

<table style="width: 100%; border: solid 1px">
    <thead>
        <tr>
            <th rowspan="3">SECCIÓN B.4: SESIONES DE REHABILITACIÓN</th>
            <th rowspan="3">Total</th>
            <th colspan="17">Por Edad (En años)</th>
            <th colspan="5">Tipo Atención</th>
        </tr>
        <tr>
            <th rowspan="2">0-4</th>
            <th rowspan="2">5-9</th>
            <th rowspan="2">10-14</th>
            <th rowspan="2">15-19</th>
            <th rowspan="2">20-24</th>
            <th rowspan="2">25-29</th>
            <th rowspan="2">30-34</th>
            <th rowspan="2">35-39</th>
            <th rowspan="2">40-44</th>
            <th rowspan="2">45-49</th>
            <th rowspan="2">50-54</th>
            <th rowspan="2">55-59</th>
            <th rowspan="2">60-64</th>
            <th rowspan="2">65-69</th>
            <th rowspan="2">70-74</th>
            <th rowspan="2">75-79</th>
            <th rowspan="2">80-más</th>
            <th colspan="3">Abierta</th>
            <th colspan="2">Cerrada</th>
        </tr>
        <tr>
            <th>Presencial</th>
            <th>A Distancia</th>
            <th>Domiciliaria</th>
            <th>UPC</th>
            <th>Cuidados Medios y Básicos</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>KINESIÓLOGO/A</td>
            <td>{{ $data['RehabKine']['total'] }}</td>
            <td>{{ $data['RehabKine']['0-3'] }}</td>
            <td>{{ $data['RehabKine']['5-9'] }}</td>
            <td>{{ $data['RehabKine']['10-14'] }}</td>
            <td>{{ $data['RehabKine']['15-19'] }}</td>
            <td>{{ $data['RehabKine']['20-24'] }}</td>
            <td>{{ $data['RehabKine']['25-29'] }}</td>
            <td>{{ $data['RehabKine']['30-34'] }}</td>
            <td>{{ $data['RehabKine']['35-39'] }}</td>
            <td>{{ $data['RehabKine']['40-44'] }}</td>
            <td>{{ $data['RehabKine']['45-49'] }}</td>
            <td>{{ $data['RehabKine']['50-54'] }}</td>
            <td>{{ $data['RehabKine']['55-59'] }}</td>
            <td>{{ $data['RehabKine']['60-64'] }}</td>
            <td>{{ $data['RehabKine']['65-69'] }}</td>
            <td>{{ $data['RehabKine']['70-74'] }}</td>
            <td>{{ $data['RehabKine']['75-79'] }}</td>
            <td>{{ $data['RehabKine']['80-max'] }}</td>
            <td>{{ $data['rehabKineTipoAtencion']['abierta'] }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $data['rehabKineTipoAtencion']['upc'] }}</td>
            <td>{{ $data['rehabKineTipoAtencion']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>TERAPEUTA OCUPACIONAL</td>
            <td>{{ $data['RehabTO']['total'] }}</td>
            <td>{{ $data['RehabTO']['0-3'] }}</td>
            <td>{{ $data['RehabTO']['5-9'] }}</td>
            <td>{{ $data['RehabTO']['10-14'] }}</td>
            <td>{{ $data['RehabTO']['15-19'] }}</td>
            <td>{{ $data['RehabTO']['20-24'] }}</td>
            <td>{{ $data['RehabTO']['25-29'] }}</td>
            <td>{{ $data['RehabTO']['30-34'] }}</td>
            <td>{{ $data['RehabTO']['35-39'] }}</td>
            <td>{{ $data['RehabTO']['40-44'] }}</td>
            <td>{{ $data['RehabTO']['45-49'] }}</td>
            <td>{{ $data['RehabTO']['50-54'] }}</td>
            <td>{{ $data['RehabTO']['55-59'] }}</td>
            <td>{{ $data['RehabTO']['60-64'] }}</td>
            <td>{{ $data['RehabTO']['65-69'] }}</td>
            <td>{{ $data['RehabTO']['70-74'] }}</td>
            <td>{{ $data['RehabTO']['75-79'] }}</td>
            <td>{{ $data['RehabTO']['80-max'] }}</td>
            <td>{{ $data['rehabTOTipoAtencion']['abierta'] }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $data['rehabTOTipoAtencion']['upc'] }}</td>
            <td>{{ $data['rehabTOTipoAtencion']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>FONOAUDIÓLOGO/A</td>
            <td>{{ $data['RehabFono']['total'] }}</td>
            <td>{{ $data['RehabFono']['0-3'] }}</td>
            <td>{{ $data['RehabFono']['5-9'] }}</td>
            <td>{{ $data['RehabFono']['10-14'] }}</td>
            <td>{{ $data['RehabFono']['15-19'] }}</td>
            <td>{{ $data['RehabFono']['20-24'] }}</td>
            <td>{{ $data['RehabFono']['25-29'] }}</td>
            <td>{{ $data['RehabFono']['30-34'] }}</td>
            <td>{{ $data['RehabFono']['35-39'] }}</td>
            <td>{{ $data['RehabFono']['40-44'] }}</td>
            <td>{{ $data['RehabFono']['45-49'] }}</td>
            <td>{{ $data['RehabFono']['50-54'] }}</td>
            <td>{{ $data['RehabFono']['55-59'] }}</td>
            <td>{{ $data['RehabFono']['60-64'] }}</td>
            <td>{{ $data['RehabFono']['65-69'] }}</td>
            <td>{{ $data['RehabFono']['70-74'] }}</td>
            <td>{{ $data['RehabFono']['75-79'] }}</td>
            <td>{{ $data['RehabFono']['80-max'] }}</td>
            <td>{{ $data['rehabFonoTipoAtencion']['abierta'] }}</td>
            <td>0</td>
            <td>0</td>
            <td>{{ $data['rehabFonoTipoAtencion']['upc'] }}</td>
            <td>{{ $data['rehabFonoTipoAtencion']['cerrado_basico_medio'] }}</td>
        </tr>

        <tr>
            <td>TOTAL</td>
            <td>
                {{
                    $data['RehabKine']['total'] +
                    $data['RehabTO']['total'] +
                    $data['RehabFono']['total']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['0-3'] +
                    $data['RehabTO']['0-3'] +
                    $data['RehabFono']['0-3']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['5-9'] +
                    $data['RehabTO']['5-9'] +
                    $data['RehabFono']['5-9']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['10-14'] +
                    $data['RehabTO']['10-14'] +
                    $data['RehabFono']['10-14']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['15-19'] +
                    $data['RehabTO']['15-19'] +
                    $data['RehabFono']['15-19']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['20-24'] +
                    $data['RehabTO']['20-24'] +
                    $data['RehabFono']['20-24']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['25-29'] +
                    $data['RehabTO']['25-29'] +
                    $data['RehabFono']['25-29']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['30-34'] +
                    $data['RehabTO']['30-34'] +
                    $data['RehabFono']['30-34']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['35-39'] +
                    $data['RehabTO']['35-39'] +
                    $data['RehabFono']['35-39']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['40-44'] +
                    $data['RehabTO']['40-44'] +
                    $data['RehabFono']['40-44']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['45-49'] +
                    $data['RehabTO']['45-49'] +
                    $data['RehabFono']['45-49']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['50-54'] +
                    $data['RehabTO']['50-54'] +
                    $data['RehabFono']['50-54']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['55-59'] +
                    $data['RehabTO']['55-59'] +
                    $data['RehabFono']['55-59']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['60-64'] +
                    $data['RehabTO']['60-64'] +
                    $data['RehabFono']['60-64']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['65-69'] +
                    $data['RehabTO']['65-69'] +
                    $data['RehabFono']['65-69']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['70-74'] +
                    $data['RehabTO']['70-74'] +
                    $data['RehabFono']['70-74']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['75-79'] +
                    $data['RehabTO']['75-79'] +
                    $data['RehabFono']['75-79']
                }}
            </td>
            <td>
                {{
                    $data['RehabKine']['80-max'] +
                    $data['RehabTO']['80-max'] +
                    $data['RehabFono']['80-max']
                }}
            </td>
            <td>
                {{
                    $data['rehabKineTipoAtencion']['abierta'] +
                    $data['rehabFonoTipoAtencion']['abierta'] +
                    $data['rehabTOTipoAtencion']['abierta']
                }}
            </td>
            <td>0</td>
            <td>0</td>
            <td>
                {{
                    $data['rehabKineTipoAtencion']['upc'] +
                    $data['rehabFonoTipoAtencion']['upc'] +
                    $data['rehabTOTipoAtencion']['upc']
                }}
            </td>
            <td>
                {{
                    $data['rehabKineTipoAtencion']['cerrado_basico_medio'] +
                    $data['rehabFonoTipoAtencion']['cerrado_basico_medio'] +
                    $data['rehabTOTipoAtencion']['cerrado_basico_medio']
                }}
            </td>
        </tr>

    </tbody>
</table>

<table style="width: 100%; border: solid 1px">
    <thead>
        <tr>
            <th>SECCIÓN B.5: DERIVACIONES Y CONTINUIDAD EN LOS CUIDADOS</th>
        </tr>
        <tr>
            <td>DERIVACIÓN</td>
            <td>TOTAL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>A OTRO HOSPITAL</td>
            <td>{{ $data['derivHosp'] }}</td>
        </tr>
        <tr>
            <td>A NIVEL SECUNDARIO</td>
            <td>{{ $data['derivAmbu'] }}</td>
        </tr>
        <tr>
            <td>A NIVEL PRIMARIO</td>
            <td>{{ $data['deriAps'] }}</td>
        </tr>
        <tr>
            <td>INSTITUCIÓN CON CONVENIO</td>
            <td>{{ $data['deriConv'] }}</td>
        </tr>
    </tbody>
</table>

<table style="width: 100%; border: solid 1px">
    <thead>
        <tr>
            <th>SECCIÓN B.6: PROCEDIMIENTOS Y ACTIVIDADES</th>
        </tr>
        <tr>
            <td>TIPO</td>
            <td>TOTAL</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>FISIOTERAPIA</td>
            <td>{{ $data['actividades']['fisioterapia'] }}</td>
        </tr>
        <tr>
            <td>ACTIVIDAD FÍSICA</td>
            <td>{{ $data['actividades']['actividad física'] }}</td>
        </tr>
        <tr>
            <td>EJERCICIOS TERAPÉUTICOS</td>
            <td>{{ $data['actividades']['ejercicios terapéuticos'] }}</td>
        </tr>
        <tr>
            <td>INTERVENCIÓN EN ACTIVIDADES DE LA VIDA DIARIA, BÁSICAS, INSTRUMENTALES Y AVANZADAS</td>
            <td>{{ $data['actividades']['intervención en actividades de la vida diaria, básicas, instrumentales y avanzadas'] }}</td>
        </tr>
        <tr>
            <td>HABILITACIÓN Y REHABILITACIÓN EDUCACIONAL</td>
            <td>{{ $data['actividades']['habilitación y rehabilitación educacional'] }}</td>
        </tr>
        <tr>
            <td>ACTIVIDADES TERAPÉUTICAS</td>
            <td>{{ $data['actividades']['actividades terapéuticas'] }}</td>
        </tr>
        <tr>
            <td>INTEGRACIÓN SENSORIAL</td>
            <td>{{ $data['actividades']['integración sensorial'] }}</td>
        </tr>
        <tr>
            <td>TRATAMIENTO COMPRESIVO</td>
            <td>{{ $data['actividades']['tratamiento compresivo'] }}</td>
        </tr>
        <tr>
            <td>HABILITACIÓN Y REHABILITACIÓN SOCIO-LABORAL</td>
            <td>{{ $data['actividades']['habilitación y rehabilitación socio-laboral'] }}</td>
        </tr>
        <tr>
            <td>ADAPTACIÓN DEL HOGAR</td>
            <td>{{ $data['actividades']['adaptación del hogar'] }}</td>
        </tr>
        <tr>
            <td>CONFECCIÓN ÓRTESIS Y/O ADAPTACIONES</td>
            <td>{{ $data['actividades']['confección órtesis y/o adaptaciones'] }}</td>
        </tr>
        <tr>
            <td>REPARACIÓN DE ÓRTESIS Y/O ADAPTACIONES</td>
            <td>{{ $data['actividades']['reparación de órtesis y/o adaptaciones'] }}</td>
        </tr>
        <tr>
            <td>CONFECCIÓN DE PRÓTESIS</td>
            <td>{{ $data['actividades']['confección de prótesis'] }}</td>
        </tr>
        <tr>
            <td>REPARACIÓN DE PRÓTESIS</td>
            <td>{{ $data['actividades']['reparación de prótesis'] }}</td>
        </tr>
        <tr>
            <td>ESTIMULACIÓN COGNITIVA</td>
            <td>{{ $data['actividades']['estimulación cognitiva'] }}</td>
        </tr>
        <tr>
            <td>REHABILITACIÓN DE LA VOZ, HABLA Y/O LENGUAJE </td>
            <td>{{ $data['actividades']['rehabilitación de la voz, habla y/o lenguaje'] }}</td>
        </tr>
        <tr>
            <td>REHABILITACIÓN DE LA DEGLUCIÓN</td>
            <td>{{ $data['actividades']['rehabilitación de la deglución'] }}</td>
        </tr>
        <tr>
            <td>REHABILITACIÓN VESTIBULAR </td>
            <td>{{ $data['actividades']['rehabilitación vestibular'] }}</td>
        </tr>
        <tr>
            <td>EDUCACIÓN A USUARIO/A, CUIDADOR/A Y/O FAMILIA</td>
            <td>{{ $data['actividades']['educación a usuario/a, cuidador/a y/o familia'] }}</td>
        </tr>
        <tr>
            <td>ATENCIÓN PSICOTERAPÉUTICA</td>
            <td>{{ $data['actividades']['atención psicoterapéutica'] }}</td>
        </tr>
        <tr>
            <td>ORIENTACIÓN Y MOVILIDAD</td>
            <td>{{ $data['actividades']['orientación y movilidad'] }}</td>
        </tr>
        <tr>
            <td>ESTIMULACIÓN SENSORIAL</td>
            <td>{{ $data['actividades']['estimulación sensorial'] }}</td>
        </tr>
        <tr>
            <td>TERAPIA RESPIRATORIA Y FUNCIONAL PULMONAR</td>
            <td>{{ $data['actividades']['terapia respiratoria y funcional pulmonar'] }}</td>
        </tr>
        <tr>
            <td>REHABILITACIÓN AUDITIVA INDIVIDUAL</td>
            <td>{{ $data['actividades']['rehabilitación auditiva individual'] }}</td>
        </tr>
        <tr>
            <td>REHABILITACIÓN AUDITIVA GRUPAL</td>
            <td>{{ $data['actividades']['rehabilitación auditiva grupal'] }}</td>
        </tr>
        <tr>
            <td>TOTAL</td>
            <td>{{ $data['actividades']['total'] }}</td>
        </tr>
    </tbody>
</table>