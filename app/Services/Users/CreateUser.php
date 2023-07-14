<?php

namespace App\Services\Users;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageIntervention;

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

            if (!file_exists(storage_path('app/public/profile-img/'))) {
                mkdir(storage_path('app/public/profile-img/'), 0775, true);
            }

            ImageIntervention::make($dto['profile_picture'])->resize(600, 600)->save(storage_path('app/public/profile-img/'.$profile_picture_file));

        }

        $user->save();

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = "Success, User was Created";
        $this->results['data'] = $user;
    }
}
