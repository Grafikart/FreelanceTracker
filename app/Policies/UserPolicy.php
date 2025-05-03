<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, User $target): bool
    {
        return $target->id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, User $target): bool
    {
        return $this->view($user, $target);
    }

    public function delete(User $user, User $target): bool
    {
        return $this->view($user, $target);
    }

    public function restore(User $user, User $target): bool
    {
        return $this->view($user, $target);
    }

    public function forceDelete(User $user, User $target): bool
    {
        return $this->view($user, $target);
    }
}
