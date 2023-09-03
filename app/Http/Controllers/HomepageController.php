<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Contracts\OrderRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        $orders = $this->orderRepository->findBy([], function (Builder $builder) use ($currentUser) {
            $builder->with('customer');
            if ($currentUser->hasRole('staff')) {
                $builder->shippingState();
            }
        }, $this->getPaginateStatus($request));

        return view('homepage', [
            'orders' => $orders,
        ]);
    }
}
