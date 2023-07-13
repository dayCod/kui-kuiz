<?php

namespace App\Services\Auth;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Logout extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {

        $user = User::where('id', $dto['user_id'])->first();

        if (!empty($user)) {
            Auth::logout();

            $user->update(['is_login' => false]);

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Successfully Logout";
            $this->results['data'] = ['email' => $user->email];

        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "User Not Found";
            $this->results['data'] = [];
        }

    }
}
