<?php

namespace App\Services\Auth;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use Illuminate\Support\Facades\Auth;

class Login extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        if ( Auth::attempt( [ 'email' => $dto['email'], 'password' => $dto['password'] ] ) ) {
            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Successfully Login";
            $this->results['data'] = ['email' => $dto['email']];
        } else {
            $this->results['response_code'] = 401;
            $this->results['success'] = false;
            $this->results['message'] = "The provided credentials do not match our records";
            $this->results['data'] = [];
        }

    }
}
