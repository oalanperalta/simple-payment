<?php
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getTypeById($userId)
    {
        return User::where('id', $userId)->pluck('type_id')->first();
    }
}
