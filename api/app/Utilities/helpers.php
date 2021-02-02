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
if (!function_exists('my_comp')) {
    function my_comp()
    {
        return \App\Models\Company::find(user()->company_id);
    }
}

if (!function_exists('my_customer')) {
    function my_customer()
    {
        return my_comp()->customer();
    }
}

if (!function_exists('my_customer_by_uuid')) {
    function my_customer_by_uuid(string $uuid)
    {
        return my_comp()->customer()->where(["uuid" => $uuid])->first();
    }
}
