<?php

namespace App\Models;

use App\Scopes\Order\OrderScope;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'customer_id',
        'recipient_address_id',
        'shipping_address_id',
        'shipping_date',
        'expected_delivery_date',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $casts = [
        'code' => 'string',
        'customer_id' => 'integer',
        'recipient_address_id' => 'integer',
        'shipping_address_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope);
    }
}
