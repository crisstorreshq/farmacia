<table>
	<thead>
		<tr>
            <th>Día</th>
            <th>Código</th>
            <th>Glosa</th>
            <th>Servicio</th>
            <th>Ambito</th>
            <th>Cantidad</th>
            <th>Beneficiario</th>
            <th>Transferencia</th>
            <th>Monto</th>
		</tr>
	</thead>
	<tbody>
	@foreach($data as $d)
		<tr>
            <td>{{ substr($d->fecha_prestacion, 0, 10) }}</td>
            <td>{{ $d->prestacion->codigo }}</td>
            <td>{{ $d->prestacion->descripcion }}</td>
            <td>{{ $d->unidad->nombre }}</td>
            <td>{{ $d->unidad->ambito->nombre }}</td>
            <td>{{ $d->cantidad }}</td>
            <td>{{ $d->beneficiario }}</td>
            <td>{{ $d->prestacion->valor }}</td>
            <td>{{ $d->prestacion->valor * $d->cantidad }}</td>
		</tr>
	@endforeach
	</tbody>
</table>