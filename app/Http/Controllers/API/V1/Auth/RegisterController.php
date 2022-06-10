<?php

namespace App\Http\Controllers\API\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->role_id = $request['role_id'];
        $user->save();

        $user_info = null;

        if ($request['role_id'] === 1) {
            $user_info = new Admin();
            $user_info->is_verified = 0;
        } else if ($request['role_id'] === 2) {
            $user_info = new Seller();
        } else if ($request['role_id'] === 3) {
            $user_info = new Customer();
        }

        $user_info->user_id = $user['id'];
        $user_info->firstname = $request['firstname'];
        $user_info->middlename = $request['middlename'];
        $user_info->lastname = $request['lastname'];
        $user_info->gender = $request['gender'];
        $user_info->birthday = $request['birthday'];
        $user_info->contact_no = $request['contact_no'];
        $user_info->save();

        return $this->customResponse('Successfully Registered.', [], Response::HTTP_CREATED);
    }
}
