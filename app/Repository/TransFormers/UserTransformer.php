<?php
namespace App\Repository\TransFormers;

class UserTransformer extends Transformers{
    public function transform($user){
        return [
            'employeeid' => $user->employeeid,
            'passportno' => $user->passportno,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'middlename' => $user->middlename,
            'mobileno' => $user->mobileno,
            'department' => $user->department,
            'passexp' => $user->passexp,
            'qidexp' => $user->qidexp,
            'midexp' => $user->midexp,
            'username' => $user->username,
            'remember_token' => $user->remember_token,
        ];
    }
}
