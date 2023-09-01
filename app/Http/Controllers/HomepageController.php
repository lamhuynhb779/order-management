<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OrderRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        $orders = $this->orderRepository->findBy([], function (Builder $builder) {
            $builder->with('customer');
            $builder->shippingState();
        }, $this->getPaginateStatus($request));

        return view('homepage', [
            'orders' => $orders,
        ]);
    }
}
