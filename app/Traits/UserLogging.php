<?php

namespace App\Traits;

use App\Models\LogUser;
use App\Models\LogUserDetail;
use App\Models\User;
use Exception;

trait UserLogging
{
    /**
     * register user log
     *
     * @return void
     */
    public function registLog(int $user_id): void
    {
        LogUser::insert(['user_id' => $user_id]);
    }

    /**
     * create log for registered users
     *
     * @return void
     */
    public function createLog(int $user_id, string $message, bool $user_user_attribute = false): void
    {
        $log_user = LogUser::where('user_id', $user_id)->first();

        if (empty($log_user)) throw new Exception('Log User Not Found', 404);

        if ($user_user_attribute == true) {
            $user = User::where('id', $user_id)->first();

            if (empty($user)) throw new Exception('Log User Not Found', 404);

            $message = $user->email.' '.$message;
        }

        $log_user->fill(['access_time' => now(), 'access_feature' => $message])->save();

        LogUserDetail::create([
            'log_user_id' => $log_user['id'],
            'user_id' => $user_id,
            'access_time' => $log_user['access_time'],
            'access_feature' => $log_user['access_feature'],
        ]);
    }
}
