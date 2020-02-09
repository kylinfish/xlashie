<?php
namespace App\Services;

use Cache;
use Laravel\Socialite\Two\User;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * login
     *
     * @param Laravel\Socialite\Two\User $auth_user
     * @param string $identify_provider
     * @return void
     */
    public function login(User $auth_user, $identify_provider)
    {
        if (empty($auth_user->email)) {
            throw new InvalidArgumentException('email not found');
        }
        $user = $this->repo->getUserByEmail($auth_user->email);
        if (! empty($user)) {
            return $user;
        }

        $uuid = $identify_provider . '-' . $auth_user->id;
        $auth_user->nickname ?? '';
        $auth_user->name ?? $email;
        $avatar ?? $auth_user->avatar ?? config('user.default_avatar');

        $user = $this->repo->create([
            'uuid' => $uuid,
            'name' => $auth_user->name,
            'password' => '',
            'phone' => '',
            'email' => $auth_user->email,
            'birth' => null,
            'avatar' => $auth_user->avatar,
        ]);

        return $user;
    }
}
