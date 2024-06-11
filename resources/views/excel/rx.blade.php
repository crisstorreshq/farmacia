<table>
	<thead>
		<tr>
                  <th>Día</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Unidad</th>
                  <th>Cantidad Examen</th>
                  <th>Beneficiarios</th>
                  <th>No Beneficiarios</th>
                  <th>Total (100%)</th>
                  <th>Ambito</th>
		</tr>
	</thead>
	<tbody>
	@foreach($data as $d)
		<tr>
                  <td>{{ $d->DIA }}</td>
                  <td>{{ $d->CODIGO }}</td>
                  <td>{{ $d->DESCRIPCION }}</td>
                  <td>{{ $d->UNIDAD }}</td>
                  <td>{{ $d->CANTIDAD_EXAMEN }}</td>
                  <td>{{ $d->BENEFICIARIOS }}</td>
                  <td>{{ $d->NO_BENEFICIARIOS }}</td>
                  <td>{{ $d->TOTAL }}</td>
                  <td>{{ $d->AMBITO }}</td>
		</tr>
	@endforeach
	</tbody>
</table>