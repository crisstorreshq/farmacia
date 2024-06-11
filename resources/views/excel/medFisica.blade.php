<table>
	<thead>
		<tr>
			<th>Profesional</th>
			<th>Diagnóstico</th>
			<th>Ficha</th>
			<th>RUT</th>
			<th>SEXO</th>
			<th>PREVISION</th>
			<th>EDAD</th>
            <th>Nacionalidad</th>
			<th>Convenio</th>
			<th>Ingreso</th>
			<th>Tipo</th>
			<th>DESC_PREST</th>
			<th>COD_PREST</th>
			<th>Referencia</th>
			<th>Num Presta</th>
			<th>Fecha_Ingreso</th>
            <th>Fecha_Alta</th>
			<th>Servicio</th>
			<th>Covid</th>
		</tr>
	</thead>
	<tbody>
	@foreach($data as $d)
		<tr>
			<td>{{ $d->nombre_profesional }}</td>
			<td>{{ $d->diagnostico }}</td>
			<td>{{ $d->PAC_CAR_NumerFicha }}</td>
			<td>{{ $d->PAC_PAC_Rut }}</td>
			<td>{{ $d->sexo }}</td>
			<td>{{ $d->prevision }}</td>
			<td>{{ $d->edad }}</td>
            <td>{{ $d->NAC_Descripcion }}</td>
			<td>{{ $d->id_convenio }}</td>
			<td>{{ $d->id_ingreso }}</td>
			<td>{{ $d->tipo }}</td>
			<td>{{ $d->descripcion }}</td>
			<td>{{ $d->codigo }}</td>
			<td>{{ $d->referencia }}</td>
			<td>{{ $d->num_prestacion }}</td>
			<td>{{ $d->fecha_ingreso }}</td>
            <td>{{ $d->fecha_alta }}</td>
			<td>{{ $d->servicio }}</td>
			<td>{{ $d->covid }}</td>
		</tr>
	@endforeach
	</tbody>
</table>