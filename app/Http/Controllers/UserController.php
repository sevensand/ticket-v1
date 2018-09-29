<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Response;
use App\Repository\TransFormers\UserTransformer;
use \Illuminate\Http\Response as Res;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;
class UserController extends ApiController
{
    protected $userTransformer;
    public function __construct(userTransformer $userTransformer){
    $this->userTransformer = $userTransformer;
    }

    public function authenticate(Request $request){
    $rules = array (
        'username' => 'required',
        'password' => 'required',
    );
    $validator = Validator::make($request->all(), $rules);
    if ($validator-> fails()){
        return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
    }
    else{
        $user = User::where('username', $request['username'])->first();
        if($user){
            $remember_token= $user->remember_token;
            if ($remember_token == NULL){
                return $this->_login($request['username'], $request['password']);
            }
            try{
                $user = JWTAuth::toUser($remember_token);
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Already logged in',
                    'data' => $this->userTransformer->transform($user)
                ]);
            }catch(JWTException $e){
                $user->remember_token = NULL;
                $user->save();
                return $this->respondInternalError("Login Unsuccessful. An error occurred while performing an action!");
            }
        }
        else{
            return $this->respondWithError("Invalid Email or Password");
        }
    }
  }




        private function _login($username, $password)
        {
          $credentials = ['username' => $username, 'password' => $password];

          if ( ! $token = JWTAuth::attempt($credentials)) {
            return $this->respondWithError("User does not exist!");
          }
          $user = JWTAuth::toUser($token);
          $user->remember_token = $token;
          $user->save();
          return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => 'Login successful!',
            'data' => $this->userTransformer->transform($user)
          ]);
        }



        private function _register($username, $password)
        {
          $credentials = ['username' => $username, 'password' => $password];

          if ( ! $token = JWTAuth::attempt($credentials)) {
            return $this->respondWithError("User does not exist!");
          }
          $user = JWTAuth::toUser($token);
          $user->remember_token = $token;
          $user->save();
          return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => 'Register successful!',
            'data' => $this->userTransformer->transform($user)
          ]);
        }


// REGISTER USER
        public function register(Request $request){
        $rules = array (
            'employeeid' => 'required',
            'passportno' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'department' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails()){
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else{
            $user = User::create([
                'employeeid' => $request['employeeid'],
                'passportno' => $request['passportno'],
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'middlename' => $request['middlename'],
                'mobileno' => 'none',
                'department' => $request['department'],
                'passexp' =>  Carbon::today(),
                'qidexp' => Carbon::today(),
                'midexp' => Carbon::today(),
                'avatar' => 'employee/avatar.png',
                'datejoin' => $request['datejoin'],
                'username' => $request['username'],
                'password' => \Hash::make($request['password']),
            ]);
            return $this->_register($request['username'], $request['password']);
        }
    }


// LOGOUT


    public function logout($remember_token){
        try{
            $user = JWTAuth::toUser($remember_token);
            $user->remember_token = NULL;
            $user->save();
            JWTAuth::setToken($remember_token)->invalidate();
            $this->setStatusCode(Res::HTTP_OK);
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Logout successful!',
            ]);

        }catch(JWTException $e){
            return $this->respondInternalError("An error occurred while performing an action!");
        }
    }

  // UPDATE


  public function update(Request $request) {
    $rules = array (
        'employeeid' => 'required',
        'passportno' => 'required',
        'firstname' => 'required',
        'lastname' => 'required',
        'middlename' => 'required',
        'mobileno' => 'required',
        'department' => 'required',
        'passexp' => 'required',
        'qidexp' => 'required',
        'midexp' => 'required'
    );
    $validator = Validator::make($request->all(), $rules);
    if ($validator-> fails()){
        return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
    } else {

        $remember_token = $request['remember_token'];
        $user = JWTAuth::toUser($remember_token);
        $user = User::find($request['id']);
        $user->id = $user->id;
        $user->employeeid = $request['employeeid'];
        $user->passportno = $request['passportno'];
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->middlename = $request['middlename'];
        $user->mobileno = $request['mobileno'];
        $user->department = $request['department'];
        $user->passexp = $request['passexp'];
        $user->qidexp = $request['qidexp'];
        $user->midexp = $request['midexp'];
        $user->save();

        return $this->respondCreated("Successfully Updated", $this->userTransformer->transform($user));
    }
  }


}
