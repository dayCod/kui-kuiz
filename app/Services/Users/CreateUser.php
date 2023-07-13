<?php

namespace App\Services\Users;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CreateUser extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $user = new User([
            'uuid' => $dto['uuid'],
            'name' => $dto['name'],
            'email' => $dto['email'],
            'password' => $dto['password'],
            'role' => $dto['role'],
        ]);

        if (!is_null($dto['profile_picture'])) {
            $profile_picture_file = 'profile-'.time().'.'.$dto['profile_picture']->getClientOriginalExtension();

            $user['profile_picture'] = url("storage/profile-img/$profile_picture_file");

            Storage::disk(config('filesystems.default'))->put("/public/profile-img/$profile_picture_file", file_get_contents($dto['profile_picture']->getRealPath()));
        }

        $user->save();

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = "Success, User was Created";
        $this->results['data'] = $user;
    }
}
