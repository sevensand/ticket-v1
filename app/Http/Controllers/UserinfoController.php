<?php

namespace App\Http\Controllers;

use App\Userinfo;
use Illuminate\Http\Request;
use JWTAuth;
use App\Repository\TransFormers\UserTransformer;
use Validator;
class UserinfoController extends ApiController
{
  protected $userTransformer;
  public function __construct(userTransformer $userTransformer){
  $this->userTransformer = $userTransformer;
  }

  public function getuserinfo(Request $request){
    $rules = array (
        'employeeid' => 'required',
    );
  $validator = Validator::make($request->all(), $rules);
  if ($validator-> fails()){
      return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
  }
  else{

      $employeeid = $request['employeeid'];
      $userinfo = Userinfo::where('employeeid', '=', $employeeid)->first();
      if(count($userinfo) > 0)
      {
        return $this->respond([
            'status' => 'success',
            'message' => 'Employee Id Found!!',
            'data' => $userinfo
        ]);
      } else {
        return $this->respond([
            'status' => 'error',
            'message' => 'Employee Id Not Found!!'
        ]);
      }
    }
  }

  public function validateEmployeeid(Request $request){
    $rules = array (
      'employeeid' => 'required',
      'passportno' => 'required'
    );
    $validator = Validator::make($request->all(), $rules);
    if ($validator-> fails()){
        return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
    } else {
      $employeeid = $request['employeeid'];
      $passportno = $request['passportno'];
      $userinfo = Userinfo::where([['employeeid', '=', $employeeid], ['passportno', '=', $passportno]])->first();
      if(count($userinfo) >0) {
        return $this->respond([
          'status' => 'success',
          'status_code' => $this->getStatusCode(),
          'message' => 'Passport and Employee id Matched',
          'data' => $userinfo
        ]);
      } else {
        return $this->respond([
          'status' => 'error',
          'status_code' => $this->getStatusCode(),
          'message' => 'Passport Not Matched',
          'data' => $userinfo
        ]);
      }
    }
  }
}
