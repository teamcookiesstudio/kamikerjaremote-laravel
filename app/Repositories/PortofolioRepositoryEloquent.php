<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PortofolioRepository;
use App\Models\Portofolio;

/**
 * Class PortofolioRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PortofolioRepositoryEloquent extends BaseRepository implements PortofolioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Portofolio::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
