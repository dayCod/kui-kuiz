<?php

namespace App\Services\Users;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\User;

class GetTrashedUser extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $trashed_user = User::onlyTrashed()->where('role', $dto['role'])->get();

        if ($trashed_user->count() > 0) {
            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Users Found";
            $this->results['data'] = $trashed_user->toArray();
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "Users Not Found";
            $this->results['data'] = [];
        }
    }
}
