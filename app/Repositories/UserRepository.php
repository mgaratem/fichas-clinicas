<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class UserRepository {

    public function create($name, $email)
    {
        $user = User::updateOrCreate(['email' => $email], ['name' => $name]); 
        return $user;
    }

    public function findById($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }
}