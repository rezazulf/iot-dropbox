<?php

namespace App\Http\Controllers;

use App\Models\Tempatsampah;
use App\Models\Pengosongansampah;
use App\Models\User;
use App\Notifications\SendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


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
        $data['rows'] = Tempatsampah::where('kota', 'like', '%' . $request->q . '%')->paginate(10);
        $data['rows'] = Tempatsampah::where('keterangan', 'like', '%' . $request->q . '%')->paginate(10);     
        $data['rows'] = Tempatsampah::with('user')->paginate(10);
        // dd($data);
        return view('tempatsampah.index', $data, compact('data'));
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
          $data['jenis_limbah'] = ['Medis' => 'Medis', 'Non-Medis' => 'Non-Medis'];
          $users= User::all();
          $users = User::where('status', 'Aktif')->get();
         return view('tempatsampah.create', $data, compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Support\Str;
     */
     public function store(Request $request)
    {
        $request->validate([
            // 'id_tempat_sampah' => 'required',
            'id_user' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'keterangan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'foto_tempatsampah' => 'required',
            'status' => 'required',
            'jenis_limbah' => 'required',
        ]);

        $tempatsampah = new Tempatsampah();
        $tempatsampah->id_tempat_sampah = Str::uuid()->toString();
        $tempatsampah->id_user = $request->id_user;
        $gambar = $request->foto_tempatsampah;
        $slug = Str::slug($gambar->getClientOriginalname());
        $newgambar = time(). '_'.$slug;
        $gambar->move('foto_tempatsampah/', $newgambar);
        $tempatsampah->alamat = $request->alamat;
        $tempatsampah->kota = $request->kota;
        $tempatsampah->keterangan = $request->keterangan;
        $tempatsampah->latitude = $request->latitude;
        $tempatsampah->longitude = $request->longitude;
        $tempatsampah->foto_tempatsampah = 'foto_tempatsampah/'.$newgambar;
        $tempatsampah->status = $request->status; 
        $tempatsampah->jenis_limbah = $request->jenis_limbah; 
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
     * @param  \App\Models\User
     * @return \Illuminate\Http\Response
     */
    public function edit(Tempatsampah $tempatsampah)
    {
        $data['title'] = 'Ubah Tempat Sampah';
        $data['row'] = $tempatsampah;
        $data['status'] = ['Aktif' => 'Aktif', 'Tidak-Aktif' => 'Tidak-Aktif'];
        $data['jenis_limbah'] = ['Medis' => 'Medis', 'Non-Medis' => 'Non-Medis'];
        $users= User::all();
        $users = User::where('status', 'Aktif')->get();
        return view('tempatsampah.edit', $data, compact('users'));
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
            'id_user' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'keterangan' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'foto_tempatsampah',
            'status' => 'required',
            'jenis_limbah' => 'required',
        ]);

      
       if(Auth::user()->level =='admin'){
        $tempatsampah->id_user = $request->id_user;
        if($request->hasFile('foto_tempatsampah')){
            $request->validate([
                'foto_tempatsampah' => 'required'
            ]);
        File::delete($tempatsampah->foto_tempatsampah);
        $gambar = $request->foto_tempatsampah;
        $slug = Str::slug($gambar->getClientOriginalname());
        $newgambar = time(). '_'.$slug;
        $gambar->move('foto_tempatsampah/', $newgambar);
        $tempatsampah->foto_tempatsampah = 'foto_tempatsampah/'.$newgambar;
        }
        $tempatsampah->id_tempat_sampah = $request->id_tempat_sampah;
        $tempatsampah->alamat = $request->alamat;
        $tempatsampah->kota = $request->kota;
        $tempatsampah->keterangan = $request->keterangan;
        $tempatsampah->latitude = $request->latitude;
        $tempatsampah->longitude = $request->longitude;
        $tempatsampah->status = $request->status;
        $tempatsampah->jenis_limbah = $request->jenis_limbah;
        $tempatsampah->save();
        
        Notification::send('Tempat Sampah Lokasi '.$request->keterangan.', '.$request->alamat.', '.$request->kota.' Telah Diperbaharui', new SendNotification());
        
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
        File::delete($tempatsampah->foto_tempatsampah);
        return redirect('tempatsampah')->with('success', 'Hapus Data Berhasil');
    }
}