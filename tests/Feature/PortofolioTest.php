<?php

namespace Tests\Feature;

use App\Models\Portofolio;
use Tests\Repositories\PortofolioRepository;
use Tests\TestCase;

class PortofolioTest extends TestCase
{
    public function testStorePortofolio()
    {
        $data = [
            'member_id'        => rand(1, 3),
            'project_name'     => 'HUHU',
            'start_date'       => date('Y-m-d H:i:s'),
            'end_date'         => date('Y-m-d H:i:s'),
            'project_on_going' => false,
            'thumbnail'        => null,
            'description'      => 'test',
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        $portofolioRepository = new PortofolioRepository(new Portofolio());

        $portofolio = $portofolioRepository->createPortofolio($data);

        $this->assertInstanceOf(Portofolio::class, $portofolio);

        foreach ($data as $key => $value) {
            $this->assertEquals($data[$key], $portofolio->$key);
        }
    }

    public function testUpdatePortofolio()
    {
        $data = [
            'member_id'        => rand(1, 3),
            'project_name'     => 'HUHU',
            'start_date'       => date('Y-m-d H:i:s'),
            'end_date'         => date('Y-m-d H:i:s'),
            'project_on_going' => false,
            'thumbnail'        => null,
            'description'      => 'test',
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        $portofolio = factory(Portofolio::class)->create();

        $portofolioRepository = new PortofolioRepository($portofolio);

        $update = $portofolioRepository->updatePortofolio($data);

        $this->assertTrue($update);

        foreach ($data as $key => $value) {
            $this->assertEquals($data[$key], $portofolio->$key);
        }
    }
}
