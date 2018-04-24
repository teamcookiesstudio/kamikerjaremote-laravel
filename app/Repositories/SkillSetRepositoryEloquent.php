<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SkillSetRepository;
use App\Models\SkillSet;

/**
 * Class SkillSetRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SkillSetRepositoryEloquent extends BaseRepository implements SkillSetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SkillSet::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
