<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\DiscountRepositoy;

class DiscountController extends \App\Http\Controllers\Controller
{
    public function __construct(DiscountRepositoy $discount_repo)
    {
        $this->company_id = user()->company->id;
        $this->repo = $discount_repo;
    }

    public function index(Request $request)
    {
        $discounts = $this->repo->getDiscounts($this->company_id);

        return response()->json($discounts, 200);
    }
}
