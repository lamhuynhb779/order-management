<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|Ward whereGsoId($value)
 */
class Ward extends Model
{
    protected $table = 'wards';

    protected $fillable = [
        'name',
        'gso_id',
        'published',
        'district_id',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
