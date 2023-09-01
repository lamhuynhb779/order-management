<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
    ];
}
