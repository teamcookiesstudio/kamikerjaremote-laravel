<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio;
use App\Http\Requests\PortofolioRequest;
use Image, Auth;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortofolioRequest $request)
    {
        $portofolio = new Portofolio;
        $portofolio->member_id = $request->member_id;
        $portofolio->project_name = $request->project_name;
        $portofolio->start_date = date('Y-m-d', strtotime($request->start_date_year.' '.$request->start_date_month));
        $portofolio->description = $request->description;
        $portofolio->project_on_going = $request->project_on_going;
        $portofolio->project_url = $request->project_url;
        if(!empty($request->end_date_year) && !empty($request->end_date_month)){
            $portofolio->end_date = date('Y-m-d', strtotime($request->end_date_year.' '.$request->end_date_month));
        }
        $portofolio->save();

        if($request->hasFile('thumbnail')){
            $auth = Auth::user();
            $fileName = "" . uniqid() . "." .
            $request->file("thumbnail")->getClientOriginalExtension();
            $request->file("thumbnail")->move(storage_path() . '/app/public/portofolio/'.$auth->first_name.$auth->last_name.'/', $fileName);
            
            $image = Portofolio::find($portofolio->id);
            $image->thumbnail = $fileName;
            $image->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portofolio = Portofolio::find($id);
        return response()->json([
                'portofolio' => $portofolio,
                'start_date_year' => date('Y', strtotime($portofolio->start_date)),
                'start_date_month' => date('F', strtotime($portofolio->start_date)),
                'end_date_month' => date('F', strtotime($portofolio->end_date)),
                'end_date_year' => date('Y', strtotime($portofolio->end_date)),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PortofolioRequest $request, $id)
    {
        $portofolio = Portofolio::find($id)->first();
        $portofolio->project_name = $request->project_name;
        $portofolio->start_date = date('Y-m-d', strtotime($request->start_date_year.' '.$request->start_date_month));
        $portofolio->description = $request->description;
        $portofolio->project_on_going = $request->project_on_going;
        $portofolio->project_url = $request->project_url;
        if(!empty($request->end_date_year) && !empty($request->end_date_month)){
            $portofolio->end_date = date('Y-m-d', strtotime($request->end_date_year.' '.$request->end_date_month));
        }
        $portofolio->update();

        if($request->hasFile('thumbnail')){
            $auth = Auth::user();
            $fileName = "" . uniqid() . "." .
            $request->file("thumbnail")->getClientOriginalExtension();
            $request->file("thumbnail")->move(storage_path() . '/app/public/portofolio/'.$auth->first_name.$auth->last_name.'/', $fileName);
            
            $image = Portofolio::find($portofolio->id);
            $image->thumbnail = $fileName;
            $image->update();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
