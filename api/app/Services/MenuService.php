<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\Menu;
use App\Services\ProductService;
use App\Repositories\MenuRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SubMenuRepository;

class MenuService
{
    private $company_id;

    public function __construct(
        MenuRepository $menu_repo,
        SubMenuRepository $submenu_repo,
        ProductRepository $product_repo,
        ProductService $product_service
    ) {
        $this->menu_repo = $menu_repo;
        $this->submenu_repo = $submenu_repo;
        $this->product_repo = $product_repo;
        $this->product_service = $product_service;
    }

    public function setCompanyId(int $id)
    {
        $this->company_id = $id;
    }

    public function getMenuSets()
    {
        return $this->menu_repo->getMenuSets($this->company_id);
    }

    /**
     * createMenu
     *
     * 單項: 指定 product_id 直接綁定
     * 多項(大禮包): 不指定 product_id，給 sub_menus
     *
     * @return App\Models\Menu
     */
    public function createMenu(array $data)
    {
        $this->checkValidProductIds($data);

        $data["company_id"] = $this->company_id;
        // 不綁定產品，也沒有子項目
        if (empty($data["product_id"]) && empty($data["sub_menus"])) {
            return $this->menu_repo->create([
                "company_id" => $this->company_id,
                "item_type" => Menu::ITEMTYPE_PURE_ITEM,
                "product_id" => 0,
                "name" => $data["name"],
                "sale_price" => $data["sale_price"],
                "purchase_price" => $data["purchase_price"],
            ]);
        }

        // 直接綁定產品
        if (! empty($data["product_id"])) {
            $product = $this->product_repo->getProduct($this->company_id, $data["product_id"]);
            return $this->menu_repo->create([
                "company_id" => $this->company_id,
                "item_type" => Menu::ITEMTYPE_PURE_ITEM,
                "product_id" => $product->id,
                "name" => $product->name,
                "sale_price" => $product->sale_price,
                "purchase_price" => $product->purchase_price,
            ]);
        }

        // 含有子項目
        $menu = $this->menu_repo->create([
            "company_id" => $this->company_id,
            "item_type" => Menu::ITEMTYPE_WITH_SUB_MENUS,
            "product_id" => 0,
            "name" => $data["name"],
            "sale_price" => $data["sale_price"],
            "purchase_price" => $data["purchase_price"],
        ]);

        $this->createSubMenus($menu, $data["sub_menus"]);

        return $menu;
    }

        /**
     * checkValidProductIds
     *
     * @param  array $data Data from request
     */
    private function checkValidProductIds(array $data)
    {
        // 允許不綁定產品的 Menu 新增
        if (empty($data["product_id"]) && empty($data["sub_menus"])) {
            return;
        }

        // 有指定 Product_id 就要檢查 Owner。兩種情況: 單品指定，或者複合式 Menu 集合
        $product_ids = (! empty($data["product_id"])) ? [$data["product_id"]] : Arr::pluck($data["sub_menus"], "product_id");
        if (count(array_unique($product_ids)) < count($product_ids)) {
            throw new \InvalidArgumentException("相同產品不能重複指定");
        }

        if (! $this->product_service->checkProductsOwner($this->company_id, $product_ids)) {
            throw new \InvalidArgumentException("請確定該產品是否屬於您的店家所管理");
        }
    }

    /**
     * createSubMenus 如果有子項目的話，從這個多對多的表來查
     */
    private function createSubMenus(Menu $menu, array $sub_contents)
    {
        try {
            foreach ($sub_contents as $entry) {
                $entry["menu_id"] = $menu->id;
                $this->submenu_repo->insert($entry);
            }
        } catch (\InvalidArgumentException $e) {
            $menu->delete();
            throw new \InvalidArgumentException($e->getMessage());
        } catch (\Exception $e) {
            $menu->delete();
            throw new \Exception("Menu 建立失敗，請確定選定的子項目有無錯誤");
        }
    }
}
