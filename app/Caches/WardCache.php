<?php

namespace App\Caches;

use Closure;

class WardCache extends CacheAbstract
{
    public function __construct(string $slug)
    {
        $this->cacheTime = 86400; // 1 day

        $this->slug = $slug;

        parent::__construct();
    }

    protected function setPrefix()
    {
        $this->prefix = 'wards';
    }

    public function getData(Closure $callback)
    {
        return $this->remember($callback);
    }
}
