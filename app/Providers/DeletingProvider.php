<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DeletingProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \App\Dataset::deleting(function ($dataset) {
            foreach ($dataset->StandardItems as $standardItem) {
                $standardItem->delete();
            }
        });
        \App\StandardItem::deleting(function ($standardItem){
            $standardItem->Items()->delete();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
