<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class PasienPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Users $users)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    // Hanya pasien yang bisa buat Pesanan
    public function create(Users $user)
    {
        return $user->status === 'P';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Users $users)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Users $users)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Users $users)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Users $users)
    {
        //
    }
}
