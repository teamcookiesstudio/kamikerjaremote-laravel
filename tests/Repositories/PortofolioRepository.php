<?php
namespace Tests\Repositories;

use App\Models\Portofolio;

class PortofolioRepository
{
    /**
     * PortofolioRepository constructor.
     * @param Portofolio $portofolio
     */
    public function __construct(Portofolio $portofolio)
    {
        $this->model = $portofolio;
    }

    /**
     * Create Portofolio
     * @param array $data
     * @return Portofolio
     */
    public function createPortofolio(array $data) : Portofolio
    {
        return $this->model->create($data);
    }

    /**
     * Update Portofolio
     * @param array $data
     * @return Portofolio
     */
    public function updatePortofolio(array $data) : bool
    {
        return $this->model->update($data);
    }
}