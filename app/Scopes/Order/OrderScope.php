<?php

namespace App\Scopes\Order;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class OrderScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (Auth::user()->hasRole('guest')) {
            $builder->where('created_by', Auth::user()->id);
        }

        $builder->where('orders.status', 1);
    }
}
