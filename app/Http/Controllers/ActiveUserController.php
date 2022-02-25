<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ActiveUserController extends Controller
{
    public function update($id){
        $user = User::find($id);
        if($user->active_user == 1){
           $user->active_user == 0;
        }else{
            $user->active_user == 1;
        }
        $user->save();
    }
}
