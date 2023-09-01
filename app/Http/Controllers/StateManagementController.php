<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\UpdateOrderStateRequest;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\StateRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StateManagementController extends Controller
{
    protected $orderRepository;

    protected $stateRepository;

    public function __construct(
        OrderRepository $orderRepository,
        StateRepository $stateRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->stateRepository = $stateRepository;
    }

    public function index(Request $request)
    {
        $orders = $this->orderRepository->findBy([], function (Builder $builder) {
            $builder->with('customer');
        }, $this->getPaginateStatus($request));

        $states = $this->stateRepository->findBy([], null, false);

        return view('states.index', [
            'orders' => $orders,
            'states' => $states,
        ]);
    }

    public function update(UpdateOrderStateRequest $request, int $id)
    {
        try {
            $order = $this->orderRepository->findOne($id);
            if (! $order instanceof Order) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Order is not found',
                ]);
            }

            $request = $request->validated();

            if ($request['state_id'] <= $order->state_id) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Request param is invalid',
                ]);
            }

            $isUpdated = $order->update(['state_id' => $request['state_id']]);
            if ($isUpdated) {
                return response()->json([
                    'status' => 1,
                    'message' => 'Update order state success',
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'Update order state failed',
                ]);
            }

        } catch (\Exception $exception) {

            return response()->json([
                'status' => 0,
                'message' => 'Update order state failed',
            ]);
        }
    }
}
