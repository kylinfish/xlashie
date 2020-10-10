<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Forms\ProductForm;
use App\Services\ProductService;
use App\Transformers\Product as Transformer;

class Products extends \App\Http\Controllers\Controller
{
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $limit = request('limit', 5);
        $products = Product::where('company_id', auth()->user()->company->id)->get();
        $products = $this->paginate($products, $limit);

        return $products;
    }

    public function show(Request $request, string $product_id)
    {
        $product = Product::where(['id' => $product_id, 'company_id' => auth()->user()->company->id])->first();

        if (!$product) {
            return $this->response(['message' => "查無此商品"]);
        }
        return $this->response->item($product, new Transformer);
    }

    public function store(Request $request, ProductForm $form)
    {
        $params = $request->only(["name", "avatar", "sale_price", "purchase_price", "description", "quantity", "sku"]);

        $form->validate($params);

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
