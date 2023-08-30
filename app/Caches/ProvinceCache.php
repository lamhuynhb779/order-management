<?php

namespace App\Caches;

use Closure;

class ProvinceCache extends CacheAbstract
{
    public function __construct(string $slug)
    {
        $this->cacheTime = 86400; // 1 day

        $this->slug = $slug;

        parent::__construct();
    }

    protected function setPrefix()
    {
        $this->prefix = 'provinces';
    }

    public function getData(Closure $callback)
    {
        return $this->remember($callback);
    }
}
