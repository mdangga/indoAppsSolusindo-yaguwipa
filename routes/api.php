<?php

use App\Http\Controllers\Api\XenditWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/donasi/xendit-webhook', [XenditWebhookController::class, 'handle'])
    ->middleware('throttle:60,1');