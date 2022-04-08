<table>
    <thead>
    <tr>
        <th>Alumno</th>
        <th>Concepto</th>
        <th>Precio</th>
        <th>Descuento</th>
        <th>Total</th>
        <th>Fecha de pago</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bills as $bill)
        <tr>
            <td>{{ $bill->user->name. ' ' . $bill->user->lastname . ' ' . $bill->user->mothers_lastname }}</td>
            <td>{{ $bill->description }}</td>
            <td>{{ $bill->price }}</td>
            <td>{{ $bill->discount }}</td>
            <td>{{ $bill->total }}</td>
            <td>{{ $bill->paid_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
