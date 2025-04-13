<?php

namespace App\Policies;

use App\Models\Asset;
use App\Models\User;

class AssetPolicy
{
    /**
     * Determine whether the user can view the asset.
     */
    public function view(User $user, Asset $asset)
    {
        // Allow users to view assets that belong to their business entities
        return $user->id === $asset->businessEntity->user_id;
    }

    /**
     * Determine whether the user can create assets.
     */
    public function create(User $user)
    {
        // Allow all authenticated users to create assets
        return true;
    }

    /**
     * Determine whether the user can update the asset.
     */
    public function update(User $user, Asset $asset)
    {
        // Allow users to update assets that belong to their business entities
        return $user->id === $asset->businessEntity->user_id;
    }

    /**
     * Determine whether the user can delete the asset.
     */
    public function delete(User $user, Asset $asset)
    {
        // Allow users to delete assets that belong to their business entities
        return $user->id === $asset->businessEntity->user_id;
    }
} 