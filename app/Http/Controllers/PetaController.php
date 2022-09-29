<?php

namespace App\Http\Controllers;

use App\Models\Tempatsampah;
use App\Models\Viewtransaksi;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $data['title'] = 'Peta Persebaran';
          $data['q'] = $request->q;
          $data['rows'] = Viewtransaksi::where('status', 'Aktif')->get();
        //   $data['gambar'] = Tempatsampah::all();
        return view('peta.index', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tempatsampah  $tempatsampah
     * @return \Illuminate\Http\Response
     */
    public function show(Tempatsampah $tempatsampah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tempatsampah  $tempatsampah
     * @return \Illuminate\Http\Response
     */
    public function edit(Tempatsampah $tempatsampah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tempatsampah  $tempatsampah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tempatsampah $tempatsampah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tempatsampah  $tempatsampah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tempatsampah $tempatsampah)
    {
        //
    }
}