<?php

namespace App\Http\Controllers;

use App\Helpers\District\DistrictHelper;
use App\Helpers\Province\ProvinceHelper;
use App\Helpers\Ward\WardHelper;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepository;
use App\Services\Order\OrderService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;

    protected $orderService;

    public function __construct(
        OrderRepository $orderRepository,
        OrderService $orderService
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $orders = $this->orderRepository->findBy([$request->all()], function ($builder) {
        }, false);

        return view('orders.index', [
            'orders' => $orders,
            'provinces' => ProvinceHelper::getAll(),
            'districts' => DistrictHelper::getAll(),
            'wards' => WardHelper::getAll(),
        ]);
    }

    public function show()
    {

    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreOrderRequest $request): \Illuminate\Http\JsonResponse
    {
        // Authorization
        //        $this->authorize('create', Order::class);

        $order = $this->orderService->createNew($request->validated());
        if (! $order instanceof Order) {
            return response()->json([
                'status' => 0,
                'message' => 'Create order failed',
            ]);

        }

        return response()->json([
            'status' => 1,
            'message' => 'Create order success',
        ]);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
