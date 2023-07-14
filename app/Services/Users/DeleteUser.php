<?php

namespace App\Services\Users;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\User;

class DeleteUser extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $find_user = app('FindUser')->execute(['user_uuid' => $dto['user_uuid']]);

        if ($find_user['success']) {
            User::where('uuid', $dto['user_uuid'])->first()->delete();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Success, User Moved to Trash";
            $this->results['data'] = $find_user['data'];
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "User Not Found";
            $this->results['data'] = [];
        }
    }
}
