<?php

namespace App\Policies;

use App\Models\OrganizationType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationTypePolicy
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
     * @param  \App\Models\OrganizationType  $organizationType
     * @return mixed
     */
    public function view(User $user, OrganizationType $organizationType)
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
        // TODO
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrganizationType  $organizationType
     * @return mixed
     */
    public function update(User $user, OrganizationType $organizationType)
    {
        // TODO
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrganizationType  $organizationType
     * @return mixed
     */
    public function delete(User $user, OrganizationType $organizationType)
    {
        // TODO
        return true;
    }
}
