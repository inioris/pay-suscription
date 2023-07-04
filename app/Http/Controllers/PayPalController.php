<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\PayPalService;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use PayPalCheckoutSdk\Orders\OrdersListRequest;

class PayPalController extends Controller
{
    public function createOrder(Request $request)
    {
        $price = floatval($request->input('price'));
        $paypalService = new PayPalService();
        $order = $paypalService->createOrder($price);

        return redirect()->away($order->result->links[1]->href);
    }

    public function captureOrder(PayPalService $paypalService)
    {
        $orderId = request('order_id');

        $order = $paypalService->captureOrder($orderId);

        $data = [
                'order_id' => $orderId,
                'payment_date' => $order->payment_date,
                'amount' => $order->amount,
            ];
        return view('payment-success', $data);
    }

    public function getOrderList(PayPalService $paypalService)
    {
        $request = new OrdersListRequest();
        $request->prefer('return=representation');

        try {
            $response = $paypalService->client->execute($request);
            $orders = $response->result->orders;

            foreach ($orders as $order) {
                $orderId = $order->id;
                $paymentDate = $order->payment_date;
                $amount = $order->amount;
                $status = $order->status;
            }
        } catch (\Exception $ex) {
            dd($ex);
        }
        $name = 'Lista de Suscripciones';
        return view('list-orders', compact('orders', 'name'));
    }

}
