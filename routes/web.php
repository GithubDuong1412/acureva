<?php
use App\Http\Controllers\PayPalWebhookController;

Route::post('/paypal/webhook', [PayPalWebhookController::class, 'handleWebhook']);


use App\Http\Controllers\NewsletterController;

Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');

