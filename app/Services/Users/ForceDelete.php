<?php

namespace App\Services\Users;

use App\Models\User;
use App\Base\BaseImplement;
use App\Base\BaseInterface;
use Illuminate\Support\Facades\Storage;

class ForceDelete extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $find_user = User::onlyTrashed()->where('uuid', $dto['user_uuid'])->first();

        if (!empty($find_user)) {

            Storage::delete('/public/profile-img/'.getFileName($find_user->profile_picture));

            $find_user->forceDelete();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Success, User Deleted Permanently";
            $this->results['data'] = $find_user['data'];
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "User Not Found";
            $this->results['data'] = [];
        }
    }
}
