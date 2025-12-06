<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PayPalWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $event = $request->all();
        Log::info('PayPal Webhook', $event);

        if ($event['event_type'] === 'CHECKOUT.ORDER.COMPLETED') {
            $resource = $event['resource'];

            $payerName  = $resource['payer']['name']['given_name'] . ' ' . $resource['payer']['name']['surname'];
            $payerEmail = $resource['payer']['email_address'] ?? null;
            $amount     = $resource['gross_amount']['value'] ?? null;
            $currency   = $resource['gross_amount']['currency_code'] ?? null;
            $status     = $resource['status'] ?? null;

            if ($payerEmail) {
                // Gửi email xác nhận
                Mail::raw(
                    "Hi! {$payerName},\n\nYour payment has {$status}.\nThe amount is: {$amount} {$currency}.",
                    function ($message) use ($payerEmail) {
                        $message->to($payerEmail)
                                ->subject('PayPal Payment Confirmation');
                    }
                );
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
