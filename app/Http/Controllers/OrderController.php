<?php

namespace App\Http\Controllers;

use App\Helpers\District\DistrictHelper;
use App\Helpers\Province\ProvinceHelper;
use App\Helpers\Ward\WardHelper;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepository;
use App\Services\Order\OrderService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function show($id)
    {
        $order = $this->orderRepository->findOne($id);
        if (! $order instanceof Order) {
            return response()->json([
                'status' => 0,
                'message' => 'Order is not found',
            ]);
        }

        return view('orders.edit', [
            'order' => $order,
            'customer' => $order->customer,
            'shippingAddress' => $order->shippingAddress,
            'recipientAddress' => $order->recipientAddress,
            'provinces' => ProvinceHelper::getAll(),
            'districts' => DistrictHelper::getAll(),
            'wards' => WardHelper::getAll(),
        ]);
    }

    /**
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function store(StoreOrderRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Authorization
        //        $this->authorize('create', Order::class);

        $order = $this->orderService->createNew($request->validated());
        if (! $order instanceof Order) {
            return redirect()->back()->with('error', 'Create order failed');
        }

        return redirect()->back()->with('success', 'Create order success');
    }

    /**
     * @throws \Exception
     */
    public function update(UpdateOrderRequest $request, int $id): JsonResponse
    {
        try {
            $order = $this->orderRepository->findOne($id);
            if (! $order instanceof Order) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Update order failed',
                ]);
            }

            $this->orderService->updateOrder($order, $request->validated());

            return response()->json([
                'status' => 1,
                'message' => 'Update order success',
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 0,
                'message' => 'Update order failed',
            ]);
        }
    }

    public function delete($id): JsonResponse
    {
        try {
            $order = $this->orderRepository->findOne($id);
            if (! $order instanceof Order) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Order is not found',
                ]);
            }

            $order->delete();

            return response()->json([
                'status' => 1,
                'message' => 'Delete order success',
            ]);

        } catch (\Exception $exception) {

            Log::error('Occur happen when deleting order', [
                'error_message' => $exception->getMessage(),
                'error_trace' => $exception->getTraceAsString(),
            ]);

            return response()->json([
                'status' => 0,
                'message' => 'Delete order failed',
            ]);
        }
    }
}
