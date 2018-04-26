<?php

namespace Tests\Repositories;

use App\Models\Profile;

class ProfileRepository
{
    protected $model;
    
    /**
     * ProfileRepository constructor.
     *
     * @param Profile $profile
     */
    public function __construct(Profile $profile)
    {
        $this->model = $profile;
    }

    /**
     * Create Profile.
     *
     * @param array $data
     *
     * @return Profile
     */
    public function createProfile(array $data) : Profile
    {
        return $this->model->create($data);
    }

    /**
     * Update Profile.
     *
     * @param array $data
     *
     * @return Profile
     */
    public function updateProfile(array $data) : bool
    {
        return $this->model->update($data);
    }
}
