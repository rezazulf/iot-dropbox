<?php

namespace App\Http\Controllers;

use App\Models\Tempatsampah;
use Illuminate\Http\Request;

class KosongkanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function index(Request $request)
    {
        $data['title'] = 'Data Tempat Sampah';
        $data['q'] = $request->q;
        $data['rows'] = Tempatsampah::where('distance', '>', '0')->paginate(10);
        return view('kosongkan.index', $data);
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
         $data['title'] = 'Kosongkan Tempat Sampah';
        $data['row'] = $tempatsampah;
        $data['status'] = ['Aktif' => 'Aktif', 'Tidak-Aktif' => 'Tidak-Aktif'];
        return view('kosongkan.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tempatsampah  $tempatsampah
     * @return \Illuminate\Http\Response
     */
      public function edit(Tempatsampah $tp)
    {
        $data['title'] = 'Kosongkan Tempat Sampah';
        $data['row'] = $tp;
        return view('kosongkan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tempatsampah  $tempatsampah
     * @return \Illuminate\Http\518
     */
     public function update(Request $request, Tempatsampah $tempatsampah)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'distance' => 'required',
            'status' => 'required',
        ]);

        $tempatsampah->name = $request->name;
        $tempatsampah->latitude = $request->latitude;
        $tempatsampah->longitude = $request->longitude;
        $tempatsampah->distance = $request->distance;
        $tempatsampah->status = $request->status;
        $tempatsampah->save();
        return redirect('kosongkan')->with('success', 'Ubah Data Berhasil');
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