<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use \App\Models\OpLog;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Generate a pagination collection.
     *
     * @param array|Collection $items
     * @param int $perPage
     * @param int $page
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $perPage = $perPage ?: request('limit', 25);

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function logging(Request $request, $message = '')
    {
        $route_name = explode(__NAMESPACE__ . "\\", $request->route()->getAction()["controller"])[1];
        list($controller, $action) = explode('@', $route_name);

        OpLog::create([
            'company_id' => my_comp()->id,
            'user_id' => user()->id,
            'controller' => OpLog::CONTROL_MAP[$controller],
            'action' => OpLog::ACTION_MAP[$action],
            'sth' => $message,
        ]);
    }
}
