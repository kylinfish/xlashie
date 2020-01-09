<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\CustomerRepository;
#use App\Forms\VendorForm;
#use App\Services\Benefit\VendorService;
use App\Models\User;

class CustomerController extends \App\Http\Controllers\Controller
{
    /*
     * __construct
     *
     * @param VendorForm $form
     * @param VendorService $service
     * @return void
     */
    public function __construct(CustomerRepository $customer_repo)
    {
        // hardcode should be instead of real query
        $this->shop_id = User::find(1)->shop()->first()->id;
        $this->repo = $customer_repo;
    }

    /**
     * index list of customers
     *
     * @param Request $request
     * @param int $vendor_id
     * @return json
     */
    public function index(Request $request)
    {
        $customers = $this->repo->getCustomers($this->shop_id);

        return response()->json($customers, 200);
    }

    /**
     * show
     *
     * @param Request $request
     * @return json
     */
    public function show(Request $request, string $customer_uuid)
    {
        $customers = $this->repo->getCustomer($this->shop_id, $customer_uuid);

        return response()->json(['data' => $customers], 200);
    }

}
