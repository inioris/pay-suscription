@extends('template')

@section('content')
        <div class="container">
            <h1 class="text-center">Comprobante de Pago</h1>
            <p class="mb-3">¡Pago realizado con éxito!</p>
            <p class="mb-1">Se ha procesado el pago de la orden con el ID: {{ $order_id }}</p>
            <p class="mb-1">Fecha y hora del pago: {{ $payment_date }}</p>
            <p class="mb-1">Monto pagado: {{ $amount }}</p>
        </div>
@endsection
