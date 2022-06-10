<?php

namespace App\Billing;

use Str;

class PaymentGateway
{

  public $currency;

  public function __construct($currency)
  {
    $this->currency = $currency;
  }

  public function charge($amount)
  {
    return [
      "amount" => $amount,
      'confirmation_number' => Str::random(10),
      'currency' => $this->currency,
    ];
  }
}
