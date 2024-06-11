<table>
	<thead>
		<tr>
			<th>Fecha de Prestacion</th>
			<th>Nombre Paciente</th>
            <th>Sexo Paciente</th>
            <th>Prevision Paciente</th>
            <th>Tipo Beneficio</th>
            <th>Edad Paciente</th>
            <th>Código Prestacion</th>
            <th>Descripción Prestación</th>
			<th>Servicio</th>
            <th>Ámbito</th>

		</tr>
	</thead>
	<tbody>
	@foreach($data as $d)
		<tr>
			<td>{{ $d->fecha_prestacion }}</td>
			<td>{{ $d->nombre_paciente }}</td>
			<td>{{ $d->PAC_PAC_Sexo }}</td>
			<td>{{ $d->PAC_PAC_Prevision }}</td>
			<td>{{ $d->PAC_PAC_TipoBenef }}</td>
            <td>{{ $d->Edad }}</td>
			<td>{{ $d->codigo }}</td>
			<td>{{ $d->descripcion }}</td>
			<td>{{ $d->servicio }}</td>
            <td>{{ $d->ambito }}</td>
		</tr>
	@endforeach
	</tbody>
</table>