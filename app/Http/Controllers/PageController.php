<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $products = [
            [
                'name' => 'Basic',
                'price' => 11,
                'features' => [
                    '10 users included',
                    '2 GB of storage',
                    'Email support',
                    'Help center access',
                ],
                'button_text' => 'Get Basic',
            ],
            [
                'name' => 'Pro',
                'price' => 22,
                'features' => [
                    '20 users included',
                    '10 GB of storage',
                    'Priority email support',
                    'Help center access',
                ],
                'button_text' => 'Get started',
            ],
            [
                'name' => 'Enterprise',
                'price' => 38,
                'features' => [
                    '30 users included',
                    '15 GB of storage',
                    'Phone and email support',
                    'Help center access',
                ],
                'button_text' => 'Contact us',
            ],
        ];

        $name ='Lista de Suscripciones';

        return view('welcome', compact('products', 'name'));
    }
}
