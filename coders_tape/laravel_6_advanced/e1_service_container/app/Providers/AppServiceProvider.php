<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGateway;
use App\Billing\PaymentGatewayContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton(PaymentGatewayContract::class, function ($app) {
      if (request()->has('credit')) {
        // localhost:80000/pay?credit
        // localhost:80000/pay?credit=true
        return new CreditPaymentGateway("KES");
      }
      return new BankPaymentGateway("KES");
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
