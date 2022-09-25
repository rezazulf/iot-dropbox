<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use Carbon\Carbon;
use App\Models\Pengosongansampah;
use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
     public function index()
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
        $data['title'] = 'Grafik Tempat Sampah';
    return view('chart', $data);
    }
}