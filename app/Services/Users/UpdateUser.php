<?php

namespace App\Services\Users;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Functions\Images;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUser extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $find_user = app('FindUser')->execute(['user_uuid' => $dto['user_uuid']]);

        if ($find_user['success']) {

            $init_model_attribute = User::where('uuid', $dto['user_uuid'])->first()->fill([
                'name' => $dto['name'],
                'email' => $dto['email'],
            ]);

            if (!is_null($dto['change_password'])) $init_model_attribute['password'] = Hash::make($dto['change_password']);

            if (!is_null($dto['profile_picture'])) $init_model_attribute['profile_picture'] = (new Images('profile', 'profile-img', 600, 600))->storeToStorage($dto['profile_picture'], $find_user['data']['profile_picture']);

            $init_model_attribute->save();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'User Successfully Updated';
            $this->results['data'] = $init_model_attribute->toArray();

        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'User Not Found';
            $this->results['data'] = [];
        }
    }
}
