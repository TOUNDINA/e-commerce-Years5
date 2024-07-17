<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productname = $request->get('productname');
        $totalprice = $request->get('total');

        // Convert total price to cents (smallest currency unit)
        $totalAmountCents = (int) round($totalprice * 100);

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => $productname,
                        ],
                        'unit_amount'  => $totalAmountCents,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return "Thanks for your order. You have just completed your payment. The seller will reach out to you as soon as possible.";
    }
}
