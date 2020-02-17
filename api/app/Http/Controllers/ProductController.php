<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\ProductRepositoy;

class ProductController extends \App\Http\Controllers\Controller
{
    public function __construct(ProductRepositoy $product_repo)
    {
        $this->shop_id = 1; # HARDCODE should be replaced.
        $this->repo = $product_repo;
    }

    public function index(Request $request)
    {
        $products = $this->repo->getProducts($this->shop_id);

        return response()->json($products, 200);
    }
}
