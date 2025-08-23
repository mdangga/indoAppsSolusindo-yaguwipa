<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Notifications\StructNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class XenditWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Xendit Webhook Received:', $request->all());

        $data = $request->all();

        if (isset($data['external_id'])) {
            $id     = str_replace('donasi-', '', $data['external_id']);
            $status = strtoupper($data['status'] ?? 'UNKNOWN');

            $donasi = Donasi::with('DonasiDana')->find($id);

            if ($donasi) {
                // Update status donasi
                if (in_array($status, ['PAID', 'SETTLED'])) {
                    $donasi->update(['status' => 'approved', 'approved_at' => now()]);
                } elseif (in_array($status, ['EXPIRED', 'FAILED', 'VOIDED'])) {
                    $donasi->update(['status' => 'rejected']);
                }

                if ($donasi->DonasiDana) {
                    $donasi->DonasiDana->update([
                        'status_verifikasi' => $status,
                        'payment_id'        => $data['payment_id'] ?? null,
                        'payment_method'    => $data['payment_details']['source'] ?? $data['payment_method'] ?? null,
                        'paid_at' => isset($data['paid_at'])
                            ? Carbon::parse($data['paid_at'])->format('Y-m-d H:i:s')
                            : null,
                        'admin_fee'         => $data['fees'][0]['value'] ?? 0,
                    ]);
                }
            }

            if ($donasi->User) {
                $donasi->User->notify(new StructNotification($donasi));
            } else {
                Notification::route('mail', $donasi->email)
                    ->notify(new StructNotification($donasi));
            }
        }


        return response()->json(['message' => 'Webhook processed'], 200);
    }
}
