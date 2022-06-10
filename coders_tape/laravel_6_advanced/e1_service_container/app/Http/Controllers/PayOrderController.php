<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{

  // public function store()
  public function store(PaymentGateway $paymentGateway)
  {

    // $paymentGateway = new PaymentGateway("KES");
    dd($paymentGateway->charge(200));
  }
}
