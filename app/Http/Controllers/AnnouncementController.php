<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use JWTAuth;
use App\Repository\TransFormers\UserTransformer;
use Validator;

class AnnouncementController extends ApiController
{
    //
    protected $userTransformer;
    public function __construct(userTransformer $userTransformer) {
      $this->userTransformer = $userTransformer;
    }
    public function announcementpost(Request $request){
    $rules = array (
        'username' => 'required',
        'title' => 'required',
        'message' => 'required',
        'avatar' => 'required'
    );
    $validator = Validator::make($request->all(), $rules);
    if ($validator-> fails()){
        return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
    }
    else{
        $announcement = Announcement::create([
            'username' => $request['username'],
            'title' => $request['title'],
            'message' => $request['message'],
            'avatar' => $request['avatar']
        ]);
        $announcement->save();
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => 'Posted successful!',
        ]);
    }
}

  public function announcementlist(Request $request) {
    $announcement = Announcement::get();
    return $this->respond([
        'status' => 'success',
        'status_code' => $this->getStatusCode(),
        'message' => 'List of Announcement',
        'data' => $announcement
    ]);
  }


}
