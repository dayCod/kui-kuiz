<?php

namespace App\Services\Users;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\User;

class RestoreUser extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $user = User::onlyTrashed()->where('uuid', $dto['user_uuid'])->first();

        if (empty($user)) {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "User Not Found";
            $this->results['data'] = [];
        } else {

            $user->restore();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "User Successfully Restored";
            $this->results['data'] = $user->toArray();
        }
    }
}
