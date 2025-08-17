<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class UpdateExpiredStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:update-expired-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status menjadi expired jika tanggal selesai sudah lewat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('kerja_sama')
        ->where('tanggal_selesai', '<', now()->format('Y-m-d'))
        ->where('status', '!=', 'expired')
        ->update(['status' => 'expired']);

        DB::table('campaign')
        ->where('tanggal_selesai', '<', now()->format('Y-m-d'))
        ->where('status', '!=', 'selesai')
        ->update(['status' => 'selesai']);

        $this->info('Expired status updated successfully.');
    }
}
