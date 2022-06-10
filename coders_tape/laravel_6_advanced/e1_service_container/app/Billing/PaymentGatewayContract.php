<?php

namespace App\Billing;

interface PaymentGatewayContract
{
  public function charge($amount);

  public function setdiscount($amount);
}
