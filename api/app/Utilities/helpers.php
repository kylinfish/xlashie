<?php

use App\Models\User;

if (!function_exists('user')) {
    /**
     * Get the authenticated user.
     *
     * @return \App\Models\Auth\User
     */
    function user()
    {
        // Get user from api/web
        if (request()->is('api/*')) {
            $user = app('Dingo\Api\Auth\Auth')->user();
        } else {
            $user = auth('web')->user();
        }

        return $user;
    }
}