<?php

namespace App\Scopes\Order;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class OrderScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('guest')) {
            $builder->where('created_by', $user->id);
        }

        $builder->where('orders.status', 1);
    }
}
