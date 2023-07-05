@extends('template')

@section('content')
        <div class="container text-center">
            <p class="mb-3">¡Pago realizado con éxito!</p>
            <p class="mb-1">Se ha procesado el pago de la orden con el ID: <b>{{ $data['orderId'] }}</b></p>
            <p class="mb-1">Fecha y hora del pago: <b>{{ $data['paymentDate'] }} </b></p>
            <p class="mb-1">Monto pagado: <b>{{ $data['amount'] }} </b></p>
            <p class="mb-1">Estado: <b>{{ $data['status'] }} </b></p>
        </div>
@endsection
