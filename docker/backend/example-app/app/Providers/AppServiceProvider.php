<?php

namespace App\Providers;

use App\Helpers\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Validator::extend('phoneValidate', function ($attribute, $value) {
            try {
                return preg_match('/^\+\d{2,5}\s+\d{2}\s+\d{3}-\d{2}-\d{2}/s', $value, $matches);
            } catch (\Exception $e) {
                return false;
            }
        });
    }
}
