<?php

namespace App\Repositories;

use App\Models\Portofolio;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PortofolioRepositoryEloquent.
 */
class PortofolioRepositoryEloquent extends BaseRepository implements PortofolioRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Portofolio::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
