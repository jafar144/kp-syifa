<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PesananPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function daftarPesanan(User $user)
    {
        return $user->status == 'A';
    }

    public function detailPesanan(User $user)
    {
        return $user->status == 'A';
    }

    public function updatePesanan(User $user)
    {
        return $user->status == 'A';
    }
}
