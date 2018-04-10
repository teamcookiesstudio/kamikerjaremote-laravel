<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Http\Requests\PortfolioRequest;
use Image, Auth;

class PortfolioController extends Controller
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
    public function store(PortfolioRequest $request)
    {
        $portfolio = new Portfolio;
        $portfolio->member_id = $request->member_id;
        $portfolio->project_name = $request->project_name;
        $portfolio->start_date = date('Y-m-d', strtotime($request->start_date_year.' '.$request->start_date_month));
        $portfolio->description = $request->description;
        $portfolio->project_on_going = $request->project_on_going;
        if(!empty($request->end_date_year) && !empty($request->end_date_month)){
            $portfolio->end_date = date('Y-m-d', strtotime($request->end_date_year.' '.$request->end_date_month));
        }
        $portfolio->save();

        if($request->hasFile('thumbnail')){
            $auth = Auth::user();
            $fileName = "" . uniqid() . "." .
            $request->file("thumbnail")->getClientOriginalExtension();
            $request->file("thumbnail")->move(storage_path() . '/app/public/portfolio/'.$auth->first_name.$auth->last_name.'/', $fileName);
            
            $image = Portfolio::find($portfolio->id);
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
        //
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
    public function update(Request $request, $id)
    {
        //
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
