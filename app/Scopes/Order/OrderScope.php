<?php

namespace App\Scopes\Order;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class OrderScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('orders.status', 1);
    }
}
