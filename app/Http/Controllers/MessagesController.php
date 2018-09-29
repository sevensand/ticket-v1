<?php

namespace App\Http\Controllers;

use App\Messages;
use Illuminate\Http\Request;
use JWTAuth;
use App\Repository\TransFormers\UserTransformer;
use Validator;


class MessagesController extends ApiController
{
    //
    protected $userTransformer;
    public function __construct(userTransformer $userTransformer) {
      $this->userTransformer = $userTransformer;
    }

    public function messagespost(Request $request) {
      $rules = array (
        'subject' => 'required',
        'message' => 'required',
        'avatar' => 'required',
        'id_from' => 'required',
        'id_user' => 'required',
      );
      $validator = Validator::make($request->all(), $rules);
      if ($validator-> fails()){
          return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
      } else {
        $message = Messages::create([
            'subject' => $request['subject'],
            'message' => $request['message'],
            'avatar' => $request['avatar'],
            'id_from' => $request['id_from'],
            'id_user' => $request['id_user']
        ]);
        $message->save();
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => 'Message has been sent!',
        ]);
      }
    }


    public function messagelist(){
      $message = Messages::get();
      return $this->respond([
          'status' => 'success',
          'status_code' => $this->getStatusCode(),
          'message' => 'Message List!',
          'data' => $message
      ]);
    }
}
