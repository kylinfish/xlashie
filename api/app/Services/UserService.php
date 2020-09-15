<?php
namespace App\Services;

use Cache;
use Illuminate\Support\Str;
use Laravel\Socialite\Two\User as SocialUser;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * getOrCreate
     *
     * @param Laravel\Socialite\Two\User $auth_user
     * @param string $identify_provider
     * @return void
     */
    public function getOrCreate(SocialUser $auth_user, $identify_provider)
    {
        if (empty($auth_user->email)) {
            throw new InvalidArgumentException('使帳號缺乏帳戶辨識使用的 Eamil');
        }
        $user = \App\Models\User::where(['identify_id' => $auth_user->id])->first();
        if (! empty($user)) {
            return $user;
        }

        return \App\Models\User::create([
            'uuid' => Str::random(18),
            'name' => $auth_user->name ?? explode('@', $auth_user->email)[0],
            'email' => $auth_user->email,
            'avatar' => $auth_user->avatar ?? config('user.default_avatar'),
            'password' => '',
            'phone' => '',
            'company_id' => 0,
            'identify_id' => $auth_user->id,
            'identify_provider' => $identify_provider,
            'birth' => null,
        ]);
    }
}
