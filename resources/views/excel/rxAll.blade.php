<table>
	<thead>
		<tr>
                  <th>Rut Paciente</th>
                  <th>Nombre Paciente</th>
                  <th>Sexo Paciente</th>
                  <th>Prevision Paciente</th>
                  <th>Tipo Prevision</th>
                  <th>Codigo Prestacion</th>
                  <th>Nombre Prestacion</th>
                  <th>Tipo Prestacion</th>
                  <th>Detalle</th>
                  <th>Diagnostico</th>
                  <th>Servicio</th>
                  <th>Ambito</th>
                  <th>TM</th>
                  <th>Radiologo</th>
                  <th>Cantidad Examenes</th>
		</tr>
	</thead>
	<tbody>
	@foreach($data as $d)
		<tr>
                  <td>{{ $d->PAC_PAC_Rut }}</td>
                  <td>{{ $d->nombre_pac }}</td>
                  <td>{{ $d->PAC_PAC_Sexo }}</td>
                  <td>{{ $d->PAC_PAC_Prevision }}</td>
                  <td>{{ $d->PAC_PAC_TipoBenef }}</td>
                  <td>{{ $d->codigo }}</td>
                  <td>{{ $d->nombre }}</td>
                  <td>{{ $d->tipo }}</td>
                  <td>{{ $d->detalle }}</td>
                  <td>{{ $d->diagnostico }}</td>
                  <td>{{ $d->servicio }}</td>
                  <td>{{ $d->ambito }}</td>
                  <td>{{ $d->TM }}</td>
                  <td>{{ $d->radiologo }}</td>
                  <td>{{ $d->cantidad_examen }}</td>
		</tr>
	@endforeach
	</tbody>
</table>