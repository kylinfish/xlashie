<?php
namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Company;
use App\Forms\ProductForm;
use App\Services\ProductService;
use App\Repositories\ProductRepository;
use App\Transformers\Product as Transformer;

class ProductController extends \App\Http\Controllers\Controller
{
    use Helpers;

    public function __construct(ProductRepository $product_repo, ProductForm $form, ProductService $service)
    {
        $this->company_id = Company::find(1)->first()->id;
        $this->repo = $product_repo;
        $this->form = $form;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $products = $this->repo->getProducts($this->company_id);

        return $this->response->paginator($products, new Transformer);
    }

    public function show(Request $request, string $product_id)
    {
        $products = $this->repo->getProduct($this->company_id, $product_id);

        if (!$products) {
            return response()->json(['message' => "查無此商品"], 404);
        }
        return $this->response->item($products, new Transformer);
    }

    public function store(Request $request)
    {
        $params = $request->only(["name", "avatar", "sale_price", "purchase_price", "description", "quantity", "sku"]);

        $this->form->validate($params);

        $this->service->setCompanyId($this->company_id);

        $product = $this->service->createProduct($params);

        return $this->response->item($product, new Transformer)->setMeta([
            "message" => "{$product->name} 新增成功",
        ]);
    }

    public function delete(Request $request, int $product_id)
    {
        $this->repo->deleteMyProduct($this->company_id, $product_id);

        return response()->json(['message' => "產品刪除成功"], 200);
    }
}
