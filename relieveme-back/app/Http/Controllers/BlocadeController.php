<?php

namespace App\Http\Controllers;

use App\Models\Blocade;
use Illuminate\Http\Request;

class BlocadeController extends Controller
{

    public function __construct(private BlocadeService $blocadeService) {}

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blocade  $blocade
     * @return \Illuminate\Http\Response
     */
    public function show(Blocade $blocade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blocade  $blocade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blocade $blocade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blocade  $blocade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blocade $blocade)
    {
        //
    }
}
