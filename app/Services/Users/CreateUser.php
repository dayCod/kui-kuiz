<?php

namespace App\Services\Users;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Functions\Images;
use App\Models\User;
use App\Traits\UserLogging;

class CreateUser extends BaseImplement implements BaseInterface
{
    use UserLogging;

    public function process($dto)
    {
        $user = User::create([
            'uuid' => $dto['uuid'],
            'name' => $dto['name'],
            'email' => $dto['email'],
            'password' => $dto['password'],
            'role' => $dto['role'],
            'profile_picture' => (!is_null($dto['profile_picture']))
                ? (new Images('profile', 'profile-img', 600, 600))->storeToStorage($dto['profile_picture'])
                : null,
        ]);

        $this->registLog($user['id']);

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = "Success, User was Created";
        $this->results['data'] = $user;
    }
}
