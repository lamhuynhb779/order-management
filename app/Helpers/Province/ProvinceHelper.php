<?php

namespace App\Helpers\Province;

use App\Caches\ProvinceCache;
use App\Models\Province;

class ProvinceHelper
{
    public static function getAll(bool $fromCache = true)
    {
        $provinceCache = new ProvinceCache('');

        if ($fromCache) {
            return $provinceCache->getData(function () {
                return Province::all(['id', 'name']);
            });
        }

        return Province::all(['id', 'name']);
    }
}
