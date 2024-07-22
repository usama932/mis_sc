<?php

namespace App\Providers;
use App\Models\ClosingRecord;
use Illuminate\Support\ServiceProvider;

class ClosingRecordServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('closing_records', function () {
            $record = ClosingRecord::first();
            
            return [
                'frm_close_date' => $record->frm_close_date ?? null,
                'frm_close_upto' => $record->frm_close_upto ?? null,
                'qb_close_date'  => $record->qb_close_date  ?? null,
                'qb_close_upto'  => $record->qb_close_upto  ?? null,
            ];
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
