<table>
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $user->name . ' ' . $user->lastname . ' ' . $user->mothers_lastname }}</td>
            <td>{{ $user->email }}</td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
    <tr>
        <th>Concepto</th>
        <th>Precio</th>
        <th>Descuento</th>
        <th>Total</th>
        <th>Fecha de pago</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user->bills as $bill)
        <tr>
            <td>{{ $bill->description }}</td>
            <td>{{ $bill->price }}</td>
            <td>{{ $bill->discount }}</td>
            <td>{{ $bill->total }}</td>
            <td>{{ $bill->paid_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
