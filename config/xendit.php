<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Xendit API Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk integrasi dengan Xendit Payment Gateway
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | Tentukan environment yang digunakan:
    | 'production' - Untuk mode production/live
    | 'development' - Untuk mode development/sandbox
    |
    */
    'environment' => env('XENDIT_ENVIRONMENT', 'development'),

    /*
    |--------------------------------------------------------------------------
    | API Keys
    |--------------------------------------------------------------------------
    */
    'api_keys' => [
        'development' => env('XENDIT_DEV_SECRET_KEY'),
        'production' => env('XENDIT_PROD_SECRET_KEY'), // Diperbaiki typo: SECRET bukan SECRET
    ],

    /*
    |--------------------------------------------------------------------------
    | Webhook Configuration
    |--------------------------------------------------------------------------
    */
    'webhook' => [
        // Token verifikasi untuk validasi webhook
        'callback_token' => env('XENDIT_CALLBACK_TOKEN'),

        // Daftar event yang didukung
        'valid_events' => [
            'invoice.paid',
            'invoice.expired',
            'invoice.settled',
            'invoice.voided',
            'invoice.failed',
        ],

        // Timeout untuk request webhook (dalam detik)
        'timeout' => 30,

        // Log level untuk webhook
        'log_level' => env('XENDIT_WEBHOOK_LOG_LEVEL', 'debug'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Invoice Default Configuration
    |--------------------------------------------------------------------------
    */
    'invoice' => [
        // Mata uang default
        'currency' => 'IDR',

        // Durasi kadaluarsa invoice (dalam detik)
        'expiry_duration' => 86400, // 24 jam (dalam detik, bukan menit)

        // URL redirect setelah pembayaran
        'redirect_urls' => [
            'success' => env('APP_URL') . '/donasi/success',
            'failure' => env('APP_URL') . '/donasi/failure',
        ],

        // Pengaturan minimum dan maximum amount
        'amount_limits' => [
            'min' => 10000, // 10,000 IDR
            'max' => 100000000, // 100,000,000 IDR
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Methods Configuration
    |--------------------------------------------------------------------------
    | Diperbarui sesuai dengan metode yang tersedia di dashboard Xendit Anda
    */
    'payment_methods' => ["CREDIT_CARD", "BCA", "BNI", 'BSI', "BRI", "MANDIRI", "PERMATA", "SAHABAT_SAMPOERNA", "BNC", "ALFAMART", "INDOMARET", "OVO", "DANA", "SHOPEEPAY", "LINKAJA", "JENIUSPAY", "DD_BRI", "DD_BCA_KLIKPAY", "KREDIVO", "AKULAKU", "ATOME", "QRIS"],

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    */
    'logging' => [
        // Channel logging yang digunakan
        'channel' => env('XENDIT_LOG_CHANNEL', 'stack'),

        // Path untuk menyimpan log khusus xendit
        'path' => storage_path('logs/xendit.log'),

        // Level logging
        'level' => env('XENDIT_LOG_LEVEL', 'debug'),
    ],

    /*
    |--------------------------------------------------------------------------
    | API Endpoints
    |--------------------------------------------------------------------------
    */
    'endpoints' => [
        'development' => 'https://api.xendit.co',
        'production' => 'https://api.xendit.co',

        // Endpoint khusus untuk webhook development
        'webhook_dev' => env('NGROK_URL') . '/api/xendit-webhook',
    ],

    /*
    |--------------------------------------------------------------------------
    | Additional Settings
    |--------------------------------------------------------------------------
    */
    'settings' => [
        // Waktu timeout untuk API request (dalam detik)
        'api_timeout' => 60,

        // Versi API yang digunakan
        'api_version' => '2022-07-31',

        // Default payment method
        'default_payment_method' => 'VIRTUAL_ACCOUNT',

        // Admin fee configuration
        'admin_fee' => [
            'enabled' => env('XENDIT_ADMIN_FEE_ENABLED', true),
            'type' => 'PERCENTAGE', // 'PERCENTAGE' or 'FIXED'
            'value' => env('XENDIT_ADMIN_FEE_VALUE', 1.5), // 1.5% atau nominal tetap
            'minimum_fee' => env('XENDIT_ADMIN_FEE_MINIMUM', 2500), // Minimum fee 2,500 IDR
            'maximum_fee' => env('XENDIT_ADMIN_FEE_MAXIMUM', 10000), // Maximum fee 10,000 IDR

            // Untuk fee tetap (jika type = 'FIXED')
            'fixed_amount' => env('XENDIT_ADMIN_FEE_FIXED_AMOUNT', 2500), // Diperbaiki typo: ADMIN bukan ADIN

            // Charge bearer: 'MERCHANT' atau 'CUSTOMER'
            'charge_bearer' => env('XENDIT_ADMIN_FEE_CHARGE_BEARER', 'CUSTOMER'),
        ],

        // Tax configuration (jika ada pajak)
        'tax' => [
            'enabled' => env('XENDIT_TAX_ENABLED', false),
            'rate' => env('XENDIT_TAX_RATE', 0), // Dalam persentase
            'type' => 'VAT', // Jenis pajak
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Fee Calculation Settings
    |--------------------------------------------------------------------------
    */
    'fee_calculation' => [
        // Metode perhitungan fee: 'INCLUSIVE' atau 'EXCLUSIVE'
        'method' => env('XENDIT_FEE_CALCULATION_METHOD', 'EXCLUSIVE'),

        // Pembulatan fee
        'rounding' => [
            'enabled' => true,
            'precision' => 100,
        ],
    ],
];
