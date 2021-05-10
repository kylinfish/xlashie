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
        #XXX HARDCODE Demo Company
        $app_url_map = [
            'local' => 1,
            'staging' => 5,
            'production' => 77,
        ];

        $comp_id = user()->company_id;
        if (user()->is_demo) {
            $comp_id = $app_url_map[env('APP_ENV')] ?? user()->company_id;
        }
        return \App\Models\Company::find($comp_id);
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
