<?php

namespace App\Helpers\Ward;

use App\Caches\WardCache;
use App\Models\District;
use App\Models\Ward;

class WardHelper
{
    public static function getAll(bool $fromCache = true)
    {
        $wardCache = new WardCache('');

        if ($fromCache) {
            return $wardCache->getData(function () {
                return Ward::all(['id', 'name', 'district_id']);
            });
        }

        return District::all(['id', 'name', 'district_id']);
    }
}
