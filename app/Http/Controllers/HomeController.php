<?php

namespace App\Http\Controllers;
use App\Models\Pengosongansampah;
use App\Models\Viewtransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
       public function index(Request $request)
    {
         $record = Pengosongansampah::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
    ->where('created_at', '>=', Carbon::today()->subDay(6))
    ->groupBy('day_name','day')
    ->orderBy('day')
    ->get();
  
     $data = [];
 
     foreach($record as $row) {
        $data['label'][] = $row->day_name;
        $data['data'][] = (int) $row->count;
      }
 
    $data['chart_data'] = json_encode($data);
    $data['title'] = 'Home';
    $data['q'] = $request->q;


    if ($request->has('q')){
      $transaksi = Viewtransaksi::where('alamat', 'like', '%' . $request->q . '%')->paginate(10);
      // $transaksi = Viewtransaksi::where('kota', 'like', '%' . $request->q . '%')->paginate(10);
      // $transaksi = Viewtransaksi::where('keterangan', 'like', '%' . $request->q . '%')->paginate(10);
    }else{
      $transaksi = Viewtransaksi::paginate(10);
    }
    // $transaksi = Viewtransaksi::paginate(10);
    // $transaksi = DB::table('view_transaksi_tmpt_sampah')
    //         ->paginate(10);  

    $data['rows'] = $transaksi;

        return view('home.index', $data);
    }
}