<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use App\Http\Requests;
use App\Http\Requests\PortofolioCreateRequest;
use App\Http\Requests\PortofolioUpdateRequest;
use App\Repositories\PortofolioRepository;
use App\Http\Traits\TraitController;

/**
 * Class PortofoliosController.
 *
 * @package namespace App\Http\Controllers;
 */
class PortofoliosController extends Controller
{
    use TraitController;

    /**
     * @var PortofolioRepository
     */
    protected $repository;

    /**
     * PortofoliosController constructor.
     *
     * @param PortofolioRepository $repository
     * @param PortofolioValidator $validator
     */
    public function __construct(PortofolioRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PortofolioCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(PortofolioCreateRequest $request)
    {
        $data = $request->all();
        
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date_year.'-'.$request->start_date_month));
        
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date_year.'-'.$request->end_date_month));
        
        $portofolio = $this->repository->create($data);

        if ($request->hasFile('thumbnail')) {

            $fileName = ''.uniqid().'.'.
            
            $request->file('thumbnail')->getClientOriginalExtension();
            
            $request->file('thumbnail')->move(storage_path().'/app/public/portofolio/', $fileName);

            $portofolio->thumbnail = $fileName;
            
            $portofolio->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portofolio = $this->repository->findByField('member_id', $id);
        
        return $portofolio;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PortofolioUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PortofolioUpdateRequest $request, $id)
    {
        $data = $request->except('thumbnail');

        $data['start_date'] = date('Y-m-d', strtotime($request->start_date_year.'-'.$request->start_date_month));
        
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date_year.'-'.$request->end_date_month));
        
        $portofolio = $this->repository->update($data, $id);
        
        if ($request->hasFile('thumbnail')) {
            
            if (!empty($portofolio->thumbnail)) {
                
                $file = Storage::disk('public')->delete('/portofolio/'.$portofolio->thumbnail);
            }
            
            $fileName = ''.uniqid().'.'.
            
            $request->file('thumbnail')->getClientOriginalExtension();
            
            $request->file('thumbnail')->move(storage_path().'/app/public/portofolio/', $fileName);

            $portofolio->thumbnail = $fileName;
            
            $portofolio->update();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
