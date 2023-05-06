<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LayananPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function daftarLayanan(User $user)
    {
        return $user->status == 'A';
    }

    public function detailLayanan(User $user)
    {
        return $user->status == 'A';
    }

    public function tambahLayanan(User $user)
    {
        return $user->status == 'A';
    }

    public function updateLayanan(User $user)
    {
        return $user->status == 'A';
    }
}
