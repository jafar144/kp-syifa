<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function daftarStaff(User $user)
    {
        return $user->status == 'A';
    }

    public function detailStaff(User $user)
    {
        return $user->status == 'A';
    }

    public function tambahStaff(User $user)
    {
        return $user->status == 'A';
    }

    public function updateStaff(User $user)
    {
        return $user->status == 'A';
    }

}
