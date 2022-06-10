<?php

namespace App\Billing;

use Str;

class CreditPaymentGateway implements PaymentGatewayContract
{

  private $currency, $discount;

  public function __construct($currency)
  {
    $this->currency = $currency;
    $this->discount = 0;
  }

  public function charge($amount)
  {
    $fees = $amount * 0.03;
    return [
      "amount" => $amount - $this->discount + $fees,
      'confirmation_number' => Str::random(10),
      'currency' => $this->currency,
      'discount' => $this->discount,
      'fees' => $fees,
    ];
  }

  public function setdiscount($amount)
  {
    $this->discount = $amount;
  }
}
