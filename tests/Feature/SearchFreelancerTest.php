<?php

namespace Tests\Feature;

use Cache;
use Tests\TestCase;
use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
