<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio;
use App\Http\Requests\PortofolioRequest;
use Image, Auth, Cache;

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
        $start_date = date('Y-m-d', strtotime($request->start_date_year.'-'.$request->start_date_month));
        $end_date = date('Y-m-d', strtotime($request->end_date_year.'-'.$request->end_date_month));
        $portofolio = new Portofolio;
        $portofolio->member_id = $request->member_id;
        $portofolio->project_name = $request->project_name;
        $portofolio->start_date = $start_date;
        $portofolio->description = $request->description;
        $portofolio->project_on_going = $request->project_on_going;
        $portofolio->project_url = $request->project_url;
        $portofolio->end_date = $end_date;
        $portofolio->save();

        if($request->hasFile('thumbnail')){
            $fileName = "" . uniqid() . "." .
            $request->file("thumbnail")->getClientOriginalExtension();
            $request->file("thumbnail")->move(storage_path() . '/app/public/portofolio/', $fileName);
            
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
    public function show($memberId)
    {
        $portofolio = Portofolio::findMember($memberId)->get();
        return $portofolio;
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
        $start_date = date('Y-m-d', strtotime($request->start_date_year.'-'.$request->start_date_month));
        $end_date = date('Y-m-d', strtotime($request->end_date_year.'-'.$request->end_date_month));
        $portofolio = Portofolio::find($id);
        $portofolio->project_name = $request->project_name;
        $portofolio->start_date = $start_date;
        $portofolio->description = $request->description;
        $portofolio->project_on_going = $request->project_on_going;
        $portofolio->project_url = $request->project_url;
        $portofolio->end_date = $end_date;
        $portofolio->update();

        if($request->hasFile('thumbnail')){
            $fileName = "" . uniqid() . "." .
            $request->file("thumbnail")->getClientOriginalExtension();
            $request->file("thumbnail")->move(storage_path() . '/app/public/portofolio/', $fileName);
            
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
