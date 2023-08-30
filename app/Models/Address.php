<?php

namespace App\Models;

use App\Scopes\Address\AddressScope;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'full_address',
        'country_id',
        'province_id',
        'district_id',
        'ward_id',
    ];

    protected $casts = [
        'address' => 'string',
        'full_address' => 'string',
        'country_id' => 'integer',
        'province_id' => 'integer',
        'district_id' => 'integer',
        'ward_id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new AddressScope);
    }
}
