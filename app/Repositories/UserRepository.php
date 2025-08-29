<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function assignRole(User $user, string $role): void
    {
        $user->assignRole($role);
    }

    public function revokeRole(User $user, string $role): void
    {
        $user->removeRole($role);
    }
}
