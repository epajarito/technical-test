<?php

namespace App\Policies;

use App\Models\Inventory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Inventory $inventory): bool
    {
        return $this->itsOwner($user, $inventory);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Inventory $inventory): bool
    {
        return $this->itsOwner($user, $inventory);
    }

    public function delete(User $user, Inventory $inventory): bool
    {
        return $this->itsOwner($user, $inventory);
    }

    public function restore(User $user, Inventory $inventory): bool
    {
        return $this->itsOwner($user, $inventory);
    }

    public function forceDelete(User $user, Inventory $inventory): bool
    {
        return $this->itsOwner($user, $inventory);
    }

    private function itsOwner(User $user, Inventory $inventory): bool
    {
        if( auth()->user()->isAdmin() ){
            return true;
        }
        return $user->id == $inventory->user_id;
    }
}
