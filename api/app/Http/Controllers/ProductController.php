<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forms\ProductForm;
use App\Services\ProductService;
use App\Repositories\ProductRepository;
use App\Transformers\Product as Transformer;

class ProductController extends \App\Http\Controllers\Controller
{
    public function __construct(ProductRepository $product_repo, ProductForm $form, ProductService $service)
    {
        $this->repo = $product_repo;
        $this->form = $form;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $products = $this->repo->getProducts(user()->company->id);

        return view('products.index', ['products' => $products]);
    }

    public function show(Request $request, string $product_id)
    {
        $products = $this->repo->getProduct(user()->company->id, $product_id);

        if (!$products) {
            return response()->json(['message' => "查無此商品"], 404);
        }
        return $this->response->item($products, new Transformer);
    }

    public function create(Request $request)
    {
        $products = $this->repo->getProducts(user()->company->id);
        return view('products.create', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $params = $request->only(["name", "avatar", "sale_price", "purchase_price", "description", "quantity", "sku"]);

        $this->form->validate($params);

        $this->service->setCompanyId(user()->company->id);

        $product = $this->service->createProduct($params);

        return $this->response->item($product, new Transformer)->setMeta([
            "message" => "{$product->name} 新增成功",
        ]);
    }

    public function delete(Request $request, int $product_id)
    {
        $this->repo->deleteMyProduct(user()->company->id, $product_id);

        return response()->json(['message' => "產品刪除成功"], 200);
    }
}
