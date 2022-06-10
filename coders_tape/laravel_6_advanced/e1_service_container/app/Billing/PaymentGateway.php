<?php

namespace App\Billing;

use Str;

class PaymentGateway
{

  private $currency, $discount;

  public function __construct($currency)
  {
    $this->currency = $currency;
    $this->discount = 0;
  }

  public function charge($amount)
  {
    return [
      "amount" => $amount - $this->discount,
      'confirmation_number' => Str::random(10),
      'currency' => $this->currency,
      'discount' => $this->discount,
    ];
  }

  public function setdiscount($amount)
  {
    $this->discount = $amount;
  }
}
