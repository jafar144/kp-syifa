<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PasienAdminPolicy
{
    use HandlesAuthorization;

    public function daftarPasien(User $user)
    {
        return $user->status == 'A';
    }

    public function detailPasien(User $user)
    {
        return $user->status == 'A';
    }

    public function updatePasien(User $user)
    {
        return $user->status == 'A';
    }
}
