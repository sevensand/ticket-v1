<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'employeeid' => 'required|string',
          'passportno' => 'required|string',
          'firstname' => 'required|string',
          'lastname' => 'required|string',
          'middlename' => 'required|string',
          'mobileno' => 'required|string',
          'department' => 'required|string',
          'passexp' => 'required|string',
          'qidexp' => 'required|string',
          'midexp' => 'required|string',
          'username' => 'required|string|unique:users',
          'password' => 'required|string',
        ];
    }



public function register(RegisterFormRequest $request)
{
    $users = new User;
    $users->employeeid = $request->employeeid;
    $users->passportno = $request->passportno;
    $users->firstname = $request->firstname;
    $users->lastname = $request->lastname;
    $users->middlename = $request->middlename;
    $users->passexp = $request->passexp;
    $users->mobileno = $request->mobileno;
    $users->department = $request->department;
    $users->username = $request->username;
    $users->password = bcrypt($request->password);
    $user->save();
    return response([
        'status' => 'success',
        'data' => $users
       ], 200);
 }
}
