<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;
use App\Models\DonasiDana;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class XenditWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Xendit Webhook Received:', $request->all());

        $data = $request->all();

        if (isset($data['external_id'])) {
            $id = str_replace('donasi-', '', $data['external_id']);

            $status    = strtoupper($request->input('status'));
            $donasi = Donasi::with('DonasiDana')->find($id);

            if ($donasi) {
                if (in_array($status, ['PAID', 'SETTLED'])) {
                    // ketika PAID atau SETTLED → approved
                    $donasi->update([
                        'status' => 'approved'
                    ]);
                } elseif (in_array($status, ['EXPIRED', 'FAILED', 'VOIDED'])) {
                    // ketika gagal, expired, atau void → rejected
                    $donasi->update([
                        'status' => 'rejected'
                    ]);
                }
                $donasi->DonasiDana->update(['status_verifikasi' => $status]);
            }
        }

        return response()->json(['message' => 'Webhook processed']);
    }
}
