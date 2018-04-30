<?php

namespace Tests\Feature;

use App\Models\Profile;
use Tests\Repositories\ProfileRepository;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    public function testStoreProfile()
    {
        $data = [
            'member_id'                => rand(1, 3),
            'occupation'               => 'HUHU',
            'location'                 => date('Y-m-d H:i:s'),
            'summary'                  => date('Y-m-d H:i:s'),
            'website'                  => false,
            'url_photo_profile'        => null,
        ];

        $profileRepo = new ProfileRepository(new Profile());

        $profile = $profileRepo->createProfile($data);

        $this->assertInstanceOf(Profile::class, $profile);

        foreach ($data as $key => $value) {
            $this->assertEquals($data[$key], $profile->$key);
        }
    }

    public function testUpdateProfile()
    {
        $data = [
            'member_id'                => 1,
            'occupation'               => 'HUHU',
            'location'                 => date('Y-m-d H:i:s'),
            'summary'                  => date('Y-m-d H:i:s'),
            'url_photo_profile'        => 'https://lorempixel.com/640/480/?22330',
            'website'                  => false,
            'url_photo_profile'        => null,
        ];

        $profile = factory(Profile::class)->create();

        $profileRepo = new ProfileRepository($profile);

        $update = $profileRepo->updateProfile($data);

        $this->assertTrue($update);

        foreach ($data as $key => $value) {
            $this->assertEquals($data[$key], $profile->$key);
        }
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
