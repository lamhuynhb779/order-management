<?php

namespace App\Models;

use App\Enums\OrderState;
use App\Scopes\Order\OrderScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

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
        'state_id',
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
        'state_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderScope);
    }

    public function scopeShippingState($query)
    {
        return $query->where('orders.state_id', OrderState::SHIPPING);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function shippingAddress(): hasOne
    {
        return $this->hasOne(Address::class, 'id', 'shipping_address_id');
    }

    public function recipientAddress(): hasOne
    {
        return $this->hasOne(Address::class, 'id', 'recipient_address_id');
    }

    public function state(): HasOne
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
}
