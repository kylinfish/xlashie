<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\Menu;
use App\Services\ProductService;
use App\Repositories\MenuRepository;
use App\Repositories\SubMenuRepository;

class MenuService
{
    private $company_id;

    public function __construct(
        MenuRepository $menu_repo,
        SubMenuRepository $submenu_repo,
        ProductService $product_service
    ) {
        $this->menu_repo = $menu_repo;
        $this->submenu_repo = $submenu_repo;
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

    public function createMenu(array $data)
    {
        $has_sub_contents = array_key_exists("sub_contents", $data);

        $data["company_id"] = $this->company_id;
        $data["item_type"] = $has_sub_contents ? Menu::ITEMTYPE_WITH_SUB_MENUS : Menu::ITEMTYPE_PURE_ITEM;

        #XXX: 有點髒，看有沒有更好的作法，避免沒有 sub_contents 直接丟整組 $data 進去會噴錯
        if ($has_sub_contents) {
            $sub_contents = $data["sub_contents"];
            unset($data["sub_contents"]);
        }

        $menu = $this->menu_repo->create($data);

        if ($has_sub_contents) {
            try {
                $product_ids = Arr::pluck($sub_contents, "product_id");
                if (! $this->product_service->checkProductsOwner($this->company_id, $product_ids)) {
                    throw new \InvalidArgumentException("Don't assign products which aren't yours.");
                }

                $this->createSubMenus($menu->id, $sub_contents);
            } catch (\InvalidArgumentException $e) {
                $menu->delete();
                throw new \InvalidArgumentException($e->getMessage());
            } catch (\Exception $e) {
                $menu->delete();
                throw new \Exception("Create Menu Failed, please try again");
            }
        }

        return $menu;
    }

    /**
     * createSubMenus 如果有子項目的話，從這個多對多的表來查
     */
    private function createSubMenus(int $menu_id, array $data)
    {
        foreach ($data as $entry) {
            $entry["menu_id"] = $menu_id;
            $this->submenu_repo->insert($entry);
        }
    }
}
