<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\TagGroup;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TagGroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(Permission::$ADMINISTRATOR_ACCESS) && $user->hasPermission(Permission::$PRODUCT_MASTER);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TagGroup $tagGroup): bool
    {
        return $user->hasPermission(Permission::$ADMINISTRATOR_ACCESS) && $user->hasPermission(Permission::$PRODUCT_MASTER);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(Permission::$ADMINISTRATOR_ACCESS) && $user->hasPermission(Permission::$PRODUCT_MASTER);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TagGroup $tagGroup): bool
    {
        return $user->hasPermission(Permission::$ADMINISTRATOR_ACCESS) && $user->hasPermission(Permission::$PRODUCT_MASTER);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TagGroup $tagGroup): bool
    {
        return $user->hasPermission(Permission::$ADMINISTRATOR_ACCESS) && $user->hasPermission(Permission::$PRODUCT_MASTER);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TagGroup $tagGroup): bool
    {
        return $user->hasPermission(Permission::$ADMINISTRATOR_ACCESS) && $user->hasPermission(Permission::$PRODUCT_MASTER);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TagGroup $tagGroup): bool
    {
        return $user->hasPermission(Permission::$ADMINISTRATOR_ACCESS) && $user->hasPermission(Permission::$PRODUCT_MASTER);
    }
}
