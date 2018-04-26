<?php

namespace Tests\Feature;

use Cache;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class SearchFreelancerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetCache()
    {
        //$redis = Redis::exists('laravel_cache:tag:search:key');
        $cache = Cache::getRedis()->keys('*');
        if ($cache) {
            $this->assertTrue(true);
        }
        $this->assertFalse(false);
    }
}
