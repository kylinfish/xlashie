<?php
namespace App\Services;

use Cache;
use App\Repositories\MenuRepository;

class MenuService
{
    public function __construct(MenuRepository $repo)
    {
        $this->repo = $repo;
    }
}
