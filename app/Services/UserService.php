<?php

namespace App\Services;

use App\Models\User;
use ManaPHP\Service;
use App\Models\UserLoginLog;

/**
 * Class UserService
 * @package App\Services
 * @property-read \ManaPHP\Http\RequestInterface $request
 */
class UserService extends Service
{
    /**
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function login($user)
    {
        if ($user->status === User::STATUS_LOCKED) {
            return '您的账号已锁定，请联系我们';
        } elseif ($user->status !== User::STATUS_ACTIVE) {
            return '您的账号当前不可用';
        }

        if (time() - $user->login_time > 60) {
            $user->login_time = time();
            $user->login_ip = client_ip();
            $user->update();

            $userLoginLog = new UserLoginLog();
            $userLoginLog->user_id = $user->user_id;
            $userLoginLog->user_name = $user->user_name;
            $userLoginLog->ip = client_ip();
            $userLoginLog->user_agent = substr($this->request->getUserAgent(), 0, 256);
            $userLoginLog->create();
        }

        $ttl = seconds('7d');
        $token = jwt_encode(['user_id' => $user->user_id, 'user_name' => $user->user_name], $ttl, 'user');
        $pusherToken = jwt_encode(['user_id' => $user->user_id, 'user_name' => $user->user_name, 'role' => 'user'], $ttl, 'pusher.user');
        return ['user_name' => $user->user_name, 'token' => $token, 'pusher_token' => $pusherToken, 'ttl' => $ttl - seconds('1d')];
    }
}
