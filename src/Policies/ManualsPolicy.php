<?php

namespace Avl\AdminManuals\Policies;

use App\Models\User;
use Avl\AdminManuals\Models\Manuals;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManualsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the langs.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manuals  $manuals
     * @return mixed
     */
    public function view(User $user, Manuals $manuals)
    {
      return $user->checkRead($manuals);
    }

    /**
     * Determine whether the user can create langs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      return $user->checkCreate(new Manuals);
    }

    /**
     * Determine whether the user can update the langs.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manuals  $manuals
     * @return mixed
     */
    public function update(User $user, Manuals $manuals)
    {
      return $user->checkUpdate($manuals);
    }

    /**
     * Determine whether the user can delete the langs.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Manuals  $manuals
     * @return mixed
     */
    public function delete(User $user, Manuals $manuals)
    {
      return $user->checkDelete($manuals);
    }
}
