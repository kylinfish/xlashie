<?php
namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\User;

class UserRepository extends EloquentRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}