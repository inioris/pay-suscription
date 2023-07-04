@extends('template')

@section('content')

    <div class="container">
            <h1>Listado de Órdenes</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID de Orden</th>
                        <th>Fecha de Pago</th>
                        <th>Monto</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->paymentDate }}</td>
                            <td>{{ $order->amount }}</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
@endsection
