<?php

namespace App\Billing;

use Str;

class PaymentGateway
{
  public function charge($amount)
  {
    return [
      "amount" => $amount,
      'confirmation_number' => Str::random(),
    ];
  }
}
