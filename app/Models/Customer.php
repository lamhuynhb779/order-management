<?php

namespace App\Models;

use App\Scopes\Orders\CustomerScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CustomerScope);
    }
}
