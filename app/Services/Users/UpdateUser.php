<?php

namespace App\Services\Users;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageIntervention;

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

            if (!is_null($dto['profile_picture'])) {

                $profile_picture_file = 'profile-'.time().'.'.$dto['profile_picture']->getClientOriginalExtension();

                $init_model_attribute['profile_picture'] = url("storage/profile-img/$profile_picture_file");

                Storage::delete('/public/profile-img/'.getFileName($find_user['data']['profile_picture']));

                ImageIntervention::make($dto['profile_picture'])->resize(600, 600)->save(storage_path('app/public/profile-img/'.$profile_picture_file));

            }

            $init_model_attribute->save();

        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'User Not Found';
            $this->results['data'] = [];
        }
    }
}
