<?php

namespace App\Services\Users;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Functions\Images;
use App\Models\User;

class CreateUser extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $user = User::create([
            'uuid' => $dto['uuid'],
            'name' => $dto['name'],
            'email' => $dto['email'],
            'password' => $dto['password'],
            'role' => $dto['role'],
            'profile_picture' => (new Images('profile', 'profile-img', 600, 600))->storeToStorage($dto['profile_picture']),
        ]);

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = "Success, User was Created";
        $this->results['data'] = $user;
    }
}
