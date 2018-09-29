<?php

namespace App\Http\Controllers;

use App\User;
use App\Confirmationticket;
use Illuminate\Http\Request;
use JWTAuth;
use App\Repository\TransFormers\UserTransformer;
use Validator;
use \Illuminate\Http\Response as Res;
class AdminController extends ApiController
{
  protected $userTransformer;
  public function __construct(userTransformer $userTransformer){
  $this->userTransformer = $userTransformer;
  }

  public function Userlist(){
    $user = User::where('username', 'Not Like', 'admin')->get();
    if(count($user) > 0) {
      return $this->respond([
      'status' => 'success',
      'status_code' => $this->getStatusCode(),
      'data' => $user
    ]);
    } else {
      return $this->respond([
        'status' => 'error',
        'status_code' => $this->getStatusCode(),
        'message' => 'No Records Found!!!'
      ]);
    }
  }
  public function Upcticket(Request $request){
    $rules = array(
        'employeeid' => 'required',
        'dissued' => 'required',
        'dlocation' => 'required',
        'alocation' => 'required',
        'ddate' => 'required',
        'adate' => 'required',
        'fileloc' => 'required'
    );
    $validator = Validator::make($request->all(), $rules);
    if ($validator-> fails()){
        return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
    } else {

        if($file = $request->pdfview) {
          list($type, $ticketData) = explode(';', $request->pdfview);
          list(,$extension) = explode('/', $type);
          list(,$ticketData) = explode(',', $ticketData);
          $fileName = "ticket/".uniqid().'.'.$extension;
          $source = fopen($request->pdfview, 'r');
          $destination = fopen($fileName, 'w');
          stream_copy_to_stream($source, $destination);
          fclose($source);
          fclose($destination);

          $confirmation = Confirmationticket::create([
            'employeeid' => $request['employeeid'],
            'dissued' => $request['dissued'],
            'dlocation' => $request['dlocation'],
            'alocation' => $request['alocation'],
            'ddate' => $request['ddate'],
            'adate' => $request['adate'],
            'fileloc' => $fileName,
          ]);

          return $this->respond([
            'status' => 'success',
            'status_code' => Res::HTTP_CREATED,
            'message' => "Successfully Uploaded",
            'data' => $confirmation,
            'filenmae' => $fileName
          ]);
          $confirmation->save();
        }





    }
  }
}
