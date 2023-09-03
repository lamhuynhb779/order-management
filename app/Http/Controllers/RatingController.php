<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rating\StoreRatingRequest;
use App\Models\Order;
use App\Models\Rating;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\RatingRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RatingController extends Controller
{
    protected $ratingRepository;

    protected $orderRepository;

    public function __construct(
        RatingRepository $ratingRepository,
        OrderRepository $orderRepository
    ) {
        $this->ratingRepository = $ratingRepository;
        $this->orderRepository = $orderRepository;
    }

    public function store(StoreRatingRequest $request): RedirectResponse
    {
        try {
            $request = $request->validated();

            $order = $this->orderRepository->findOneBy([
                'id' => $request['order_id'],
                'created_by' => Auth::user()->id,
            ]);
            if (! $order instanceof Order) {
                return redirect()->back()->with('error', 'Order is not found');
            }

            $rating = $this->ratingRepository->save([
                'order_id' => $request['order_id'],
                'star' => $request['star'],
                'comment' => $request['comment'],
            ]);
            if (! $rating instanceof Rating) {
                return redirect()->back()->with('error', 'Send rating failed');
            }

            return redirect()->back()->with('success', 'Send rating success');
        } catch (\Exception $exception) {
            Log::error('Occur happen when create rating data', [
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'request' => json_encode($request),
            ]);

            return redirect()->back()->with('error', 'Send rating failed');
        }
    }
}
