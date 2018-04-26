<?php

namespace App\Repositories;

use App\Models\SkillSet;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SkillSetRepositoryEloquent.
 */
class SkillSetRepositoryEloquent extends BaseRepository implements SkillSetRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return SkillSet::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
