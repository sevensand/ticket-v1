<?php

namespace App\Http\Controllers;

use App\Confirmationticket;
use Illuminate\Http\Request;
use App\Repository\TransFormers\UserTransformer;
use Validator;
class Confirmation extends ApiController
{
  protected $userTransformer;
  public function __construct(userTransformer $userTransformer){
  $this->userTransformer = $userTransformer;
  }

  public function getConfirmationticket($employeeid){
    $confirmationticket = Confirmationticket::where('employeeid', '=', $employeeid)->get();

    if(count($confirmationticket) > 0)
    {
      return $this->respond([
          'status' => 'success',
          'status_code' => $this->getStatusCode(),
          'message' => 'Confirmation Ticker List',
          'data' => $confirmationticket

      ]);
    } else {
      return $this->respond([
          'status' => 'error',
          'message' => 'No Confirmation Ticket Found!!!'
      ]);
    }

  }
}
