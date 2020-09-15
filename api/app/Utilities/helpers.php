<?php

if (!function_exists('user')) {
    /**
     * Get the authenticated user.
     *
     * @return \App\Models\Auth\User
     */
    function user()
    {
        return auth()->user();
    }
}

if (!function_exists('u_customer')) {
    /**
     * Get the customer who belongs to Auth User
     *
     * @return \App\Models\Customer
     */
    function u_customer(string $uuid)
    {
        return \App\Models\Customer::where([
            "user_id" => auth()->user()->id,
            "uuid" => $uuid
        ])->first();
    }
}

if (!function_exists('u_menu_elo')) {
    /**
     * Get the customer who belongs to Auth User
     *
     * @return \App\Models\Menu
     */
    function u_menu_elo(int $menu_id)
    {
        return \App\Models\Menu::where([
            "id" => $menu_id,
            "company_id" => auth()->user()->company_id,
        ]);
    }
}