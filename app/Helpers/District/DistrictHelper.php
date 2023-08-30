<?php

namespace App\Helpers\District;

use App\Caches\DistrictCache;
use App\Models\District;

class DistrictHelper
{
    public static function getAll(bool $fromCache = true)
    {
        $districtCache = new DistrictCache('');

        if ($fromCache) {
            return $districtCache->getData(function () {
                return District::all(['id', 'name', 'province_id']);
            });
        }

        return District::all(['id', 'name', 'province_id']);
    }
}
