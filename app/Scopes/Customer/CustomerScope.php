<?php


namespace App\Scopes\Orders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CustomerScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {

    }
}
