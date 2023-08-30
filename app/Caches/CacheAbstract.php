<?php

namespace App\Caches;

use Closure;
use Illuminate\Support\Facades\Cache;

abstract class CacheAbstract
{
    /**
     * Define able to use cache
     *
     * @var mixed
     */
    protected $cacheAble;

    /**
     * Prefix key for store cache
     *
     * @var mixed
     */
    protected $prefix;

    /**
     * Slug key for store cache
     *
     * @var string
     */
    protected $slug;

    /**
     * Life time for store cache, then will auto clear. If it's null, cache will remember forever
     *
     * @var int
     */
    protected $cacheTime = 86400; // 60 * 60 * 24 total seconds in 24h

    /**
     * Config for store cache forever
     *
     * @var bool
     */
    protected $forever = false;

    public function __construct()
    {
        $this->cacheAble = env('CACHE_ABLE');

        $this->setPrefix();
    }

    /**
     * setPrefix
     *
     * @return void
     */
    abstract protected function setPrefix();

    /**
     * getData
     *
     * @return string
     */
    abstract public function getData(Closure $callback);

    /**
     * getKey
     *
     * @return string
     */
    public function getKey()
    {
        $key = $this->prefix;
        if (! empty($this->slug)) {
            $key .= '-'.$this->slug;
        }

        return $key;
    }

    /**
     * remember
     *
     * @return mixed
     */
    public function remember(Closure $callback)
    {
        if (! $this->cacheAble) {
            return $callback();
        }

        $value = $this->get();

        if ($value !== null) {
            return $value;
        }

        $this->put($value = $callback());

        return $value;
    }

    /**
     * get
     *
     * @return mixed
     */
    public function get()
    {
        return Cache::get($this->getKey());
    }

    /**
     * put
     *
     * @param  mixed  $value
     * @return mixed
     */
    public function put($value)
    {
        if ($this->forever) {
            return Cache::forever($this->getKey(), $value);
        }

        return Cache::put($this->getKey(), $value, $this->cacheTime);
    }

    /**
     * clear
     *
     * @return mixed
     */
    public function clear()
    {
        if (empty($this->slug)) {
            return $this->clearByPrefix();
        }

        return Cache::forget($this->getKey());
    }

    /**
     * clearByPrefix
     *
     * @return mixed
     */
    public function clearByPrefix()
    {
        return Cache::connection()->delete($this->getAllKey());
    }

    /**
     * Get all key
     *
     * @return mixed
     */
    public function getAllKey()
    {
        $prefix = Cache::getPrefix().$this->prefix;

        return Cache::connection()->keys("$prefix*");
    }
}
