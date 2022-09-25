<?php

namespace App\Http\Controllers;

use App\Models\Tempatsampah;
use App\Models\Pengosongansampah;
use App\Notifications\SendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;


class TempatsampahController extends Controller
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
        $data['rows'] = Tempatsampah::where('alamat', 'like', '%' . $request->q . '%')->paginate(10);
        return view('tempatsampah.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function create(Request $request)
    {
        $data['title'] = 'Tambah Tempat Sampah';
          $data['status'] = ['Aktif' => 'Aktif', 'Tidak-Aktif' => 'Tidak-Aktif'];
         return view('tempatsampah.create', $data);
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
            'id_tempat_sampah' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required',
        ]);

        $tempatsampah = new Tempatsampah();
        $tempatsampah->id_tempat_sampah = $request->id_tempat_sampah;
        $tempatsampah->alamat = $request->alamat;
        $tempatsampah->latitude = $request->latitude;
        $tempatsampah->longitude = $request->longitude;
        $tempatsampah->status = $request->status;
        $tempatsampah->save();
        return redirect('tempatsampah')->with('success', 'Tambah Data Berhasil');
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
        $data['title'] = 'Ubah Tempat Sampah';
        $data['row'] = $tempatsampah;
        $data['status'] = ['Aktif' => 'Aktif', 'Tidak-Aktif' => 'Tidak-Aktif'];
        return view('tempatsampah.edit', $data);
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
        $request->validate([
            'id_tempat_sampah' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required',
        ]);

      
       if(Auth::user()->level =='admin'){
        $tempatsampah->id_tempat_sampah = $request->id_tempat_sampah;
        $tempatsampah->alamat = $request->alamat;
        $tempatsampah->latitude = $request->latitude;
        $tempatsampah->longitude = $request->longitude;
        $tempatsampah->status = $request->status;
        $tempatsampah->save();
        
        Notification::send('Tempat Sampah Lokasi '.$request->alamat.' Telah Diperbaharui', new SendNotification());
        
        return redirect('tempatsampah')->with('success', 'Ubah Data Berhasil');
        }else{
        
        return redirect('kosongkansampah')->with('success', 'Pengosongan Gagal');
        }
    }

     public function update_distance(Request $request)
    {
        $id = Auth::user()->id_user ;
        $nama = Auth::user()->nama_user;

        DB::table('transaksi')->where('id_tempat_sampah', $request->id_tempat_sampah)->delete();

        Pengosongansampah::create([
            'id_tempat_sampah' =>  $request->id_tempat_sampah, # declared as fillable on Product model
            'id_user' => $id,
            'nama_user' => $nama,
        ]);
         Notification::send('Tempat Sampah Lokasi '.$request->alamat.' Telah Dikosongkan Oleh ' .$nama. '', new SendNotification());
       
         return redirect('kosongkansampah')->with('success', 'Pengosongan Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tempatsampah  $tempatsampah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tempatsampah $tempatsampah)
    {
        $tempatsampah->delete();
        return redirect('tempatsampah')->with('success', 'Hapus Data Berhasil');
    }
}