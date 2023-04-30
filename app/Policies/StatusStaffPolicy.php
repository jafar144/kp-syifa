<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusStaffPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function daftarStatusStaff(User $user)
    {
        return $user->status == 'A';
    }

    public function detailStatusStaff(User $user)
    {
        return $user->status == 'A';
    }

    public function tambahStatusStaff(User $user)
    {
        return $user->status == 'A';
    }

    public function updateStatusStaff(User $user)
    {
        return $user->status == 'A';
    }
}
