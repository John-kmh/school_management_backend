<?php

namespace App\Actions\Auth;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function execute(array $data)
    {
        $user = $this->userRepo->create([
            'fullname' => $data['fullname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $this->userRepo->assignRole($user, $data['role']);

        return $user;
    }
}
