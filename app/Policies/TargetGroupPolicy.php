<?php

namespace App\Policies;

use App\Models\TargetGroup;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TargetGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TargetGroup  $targetGroup
     * @return mixed
     */
    public function view(User $user, TargetGroup $targetGroup)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TargetGroup  $targetGroup
     * @return mixed
     */
    public function update(User $user, TargetGroup $targetGroup)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TargetGroup  $targetGroup
     * @return mixed
     */
    public function delete(User $user, TargetGroup $targetGroup)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TargetGroup  $targetGroup
     * @return mixed
     */
    public function restore(User $user, TargetGroup $targetGroup)
    {
        return $user->is_admin;
    }
}
