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

    public function daftarStaffPasien(User $user)
    {
        return $user->status == 'A';
    }

    public function detailStaffPasien(User $user)
    {
        return $user->status == 'A';
    }

    public function tambahStaff(User $user)
    {
        return $user->status == 'A';
    }

    public function updateStaffPasien(User $user)
    {
        return $user->status == 'A';
    }

}
