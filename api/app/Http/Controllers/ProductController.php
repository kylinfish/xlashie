<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Shop;
use App\Forms\ProductForm;
use App\Services\ProductService;
use App\Repositories\ProductRepository;

class ProductController extends \App\Http\Controllers\Controller
{
    public function __construct(ProductRepository $product_repo, ProductForm $form, ProductService $service)
    {
        $this->shop_id = Shop::find(1)->first()->id;
        $this->repo = $product_repo;
        $this->form = $form;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $products = $this->repo->getProducts($this->shop_id);

        return response()->json($products, 200);
    }

    public function show(Request $request, string $product_id)
    {
        $products = $this->repo->getProduct($this->shop_id, $product_id);

        if (!$products) {
            return response()->json(['message' => "查無此商品"], 404);
        }
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $params = $request->only(["name", "avatar", "cost", "price"]);

        $this->form->validate($params);

        $this->service->setShopId($this->shop_id);

        $product = $this->service->createProduct($params);

        return response()->json([
            'message' => "產品: {$product->name} 新增成功",
        ], 200);
    }

    public function delete(Request $request, int $product_id)
    {
        $this->repo->deleteMyProduct($this->shop_id, $product_id);

        return response()->json(['message' => "產品刪除成功"], 200);
    }
}
