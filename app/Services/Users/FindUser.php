<?php

namespace App\Services\Users;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\User;

class FindUser extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $user = User::where('uuid', $dto['user_uuid'])->first();

        if (empty($user)) {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "User Not Found";
            $this->results['data'] = [];
        } else {
            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "User Found";
            $this->results['data'] = $user->toArray();
        }
    }
}
