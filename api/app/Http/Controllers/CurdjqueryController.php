<?php

namespace App\Http\Controllers;

use App\Models\Curdjquery;
use Illuminate\Http\Request;

class CurdjqueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showCurdjquerys = Curdjquery::latest()->paginate(5);
        return view('index', compact('showCurdjquerys'));
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
    public function store(Request $request)
    {
        $request->validate([
            'title'         =>      'required',
            'description'   =>      'required',
        ]);

        $storeCurdjquerys  =  Curdjquery::create($request->all());

        if (!is_null($storeCurdjquerys)) {
            return response()->json(["status" => "success", "message" => "Success! post created.", "data" => $storeCurdjquerys]);
        } else {
            return response()->json(["status" => "failed", "message" => "Alert! post not created"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curdjquery  $curdjquery
     * @return \Illuminate\Http\Response
     */
    public function show(Curdjquery $curdjquery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curdjquery  $curdjquery
     * @return \Illuminate\Http\Response
     */
    public function edit(Curdjquery $curdjquery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curdjquery  $curdjquery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curdjquery $curdjquery)
    {
        $curdjquery_id = $request->id;
        $updateCurdjquery  =  Curdjquery::where("id", $curdjquery_id)->update($request->all());

        if ($updateCurdjquery == 1) {
            return response()->json(["status" => "success", "message" => "Success! post updated"]);
        } else {
            return response()->json(["status" => "failed", "message" => "Alert! post not updated"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curdjquery  $curdjquery
     * @return \Illuminate\Http\Response
     */
    public function destroy($curdjquery_id)
    {
        $deletetCurdjquery  = Curdjquery::where("id", $curdjquery_id)->delete();
        if ($deletetCurdjquery == 1) {
            return response()->json(["status" => "success", "message" => "Success! post deleted"]);
        } else {
            return response()->json(["status" => "failed", "message" => "Alert! post not deleted"]);
        }
    }
}
