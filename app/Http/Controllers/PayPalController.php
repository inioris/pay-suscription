<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayPalService;

class PayPalController extends Controller
{
    public function createOrder(Request $request)
    {
        $price = floatval($request->input('price'));
        $paypalService = new PayPalService();
        $order = $paypalService->createOrder($price);

        session(['order_id' => $order->result->id]);

        return redirect()->away($order->result->links[1]->href);
    }

    public function captureOrder(Request $request, PayPalService $paypalService)
    {
        $orderId = session('order_id');
        $order = $paypalService->captureOrder($orderId);

        session()->forget('order_id');

        $data = [
           'orderId' => $order->result->id,
           'status' => $order->result->status,
           'amount' => $order->result->purchase_units[0]->amount->value,
           'paymentDate' => $order->result->create_time,
        ];

       $name = 'Comprobante de Pago';

       return view('payment-success', compact('data', 'name'));
    }
}
