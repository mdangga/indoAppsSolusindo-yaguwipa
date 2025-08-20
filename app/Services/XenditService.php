<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\XenditSdkException;

class XenditService
{
    private $invoiceApi;

    public function __construct()
    {
        Configuration::setXenditKey(
            config('xendit.api_keys.' . config('xendit.environment'))
        );

        $this->invoiceApi = new InvoiceApi();
    }

    public function createInvoice(
        string $externalId,
        float $amount,
        string $payerEmail,
        string $description,
        string $slugCampaign,
        ?string $customerName = null,
        ?int $invoiceDuration = null,
        ?array $paymentMethods = ['QRIS']
    ) {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than 0');
        }

        $adminFee = $this->calculateAdminFee($amount);
        $fees = [];

        if ($adminFee > 0 && config('xendit.settings.admin_fee.charge_bearer') === 'CUSTOMER') {
            $fees[] = [
                'type' => 'ADMIN',
                'value' => (float) $adminFee
            ];
        }

        $successUrl = url("/donasi/success/{$slugCampaign}");
        $failureUrl = url("/donasi/failure/{$slugCampaign}");

        $payload = [
            'external_id' => $externalId,
            'amount' => (float) ($amount + $adminFee),
            'payer_email' => $payerEmail,
            'description' => $description,
            'success_redirect_url' => $successUrl,
            'failure_redirect_url' => $failureUrl,
            'currency' => config('xendit.invoice.currency', 'IDR'),
            'invoice_duration' => $invoiceDuration ?? config('xendit.invoice.expiry_duration', 86400),
            'payment_methods' => $paymentMethods,
            'items' => [[
                'name' => substr($description, 0, 254),
                'quantity' => 1,
                'price' => (float) ($amount),
                'category' => 'DONATION'
            ]],
            'fees' => $fees
        ];

        if ($customerName) {
            $payload['customer'] = [
                'given_names' => $customerName,
                'email' => $payerEmail
            ];
        }

        $createInvoiceRequest = new CreateInvoiceRequest($payload);

        try {
            return $this->invoiceApi->createInvoice($createInvoiceRequest);
        } catch (XenditSdkException $e) {
            Log::error('Xendit SDK Error: ' . $e->getMessage(), [
                'external_id' => $externalId,
                'amount' => $amount,
                'payload' => $payload
            ]);
            throw new \Exception('Payment gateway error: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Xendit General Error: ' . $e->getMessage());
            throw new \Exception('Failed to create payment invoice');
        }
    }

    // menghitung fee
    private function calculateAdminFee(float $amount): float
    {
        $feeConfig = config('xendit.settings.admin_fee');

        if (!$feeConfig['enabled']) {
            return 0;
        }

        if ($feeConfig['type'] === 'FIXED') {
            $fee = $feeConfig['fixed_amount'];
        } else {
            // Percentage calculation
            $fee = $amount * ($feeConfig['value'] / 100);
        }

        // Apply minimum and maximum limits
        $fee = max($fee, $feeConfig['minimum_fee']);
        $fee = min($fee, $feeConfig['maximum_fee']);

        // Rounding
        if (config('xendit.fee_calculation.rounding.enabled')) {
            $precision = config('xendit.fee_calculation.rounding.precision', 100);
            $fee = round($fee / $precision) * $precision;
        }

        return (float) $fee;
    }
}
