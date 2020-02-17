<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\PriceitemRepositoy;

class PriceitemController extends \App\Http\Controllers\Controller
{
    public function __construct(PriceitemRepositoy $priceitem_repo)
    {
        $this->shop_id = 1; # HARDCODE should be replaced.
        $this->repo = $priceitem_repo;
    }

    public function index(Request $request)
    {
        $priceitems = $this->repo->getPriceitems($this->shop_id);

        return response()->json($priceitems, 200);
    }
}
