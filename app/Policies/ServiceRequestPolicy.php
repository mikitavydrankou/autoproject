<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    /**
     * Create a new policy instance.
     */

    public function __construct()
    {
        //
    }

    public function delete(User $user, ServiceRequest $service_request): bool
    {
        return $user->id === $service_request->user_id;
    }

    public function update(User $user, ServiceRequest $service_request): bool
    {
        return $user->id === $service_request->user_id;
    }

    public function create(User $user, ServiceRequest $service_request): bool
    {
        return $user->id === $service_request->user_id;
    }

    public function edit(User $user, ServiceRequest $service_request): bool
    {
        return $user->id === $service_request->user_id;
    }
}
