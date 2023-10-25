<?php

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class BalanceServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Saldo awal
        $initialBalance = 13000;

        // Hitung saldo aktual di sini jika diperlukan
        $saldo = $initialBalance;

        View::share('saldo', $saldo);
    }

    public function register()
    {
        //
    }
}

