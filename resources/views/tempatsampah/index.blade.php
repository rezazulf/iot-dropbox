@extends('app')
@section('content')
@if(session('success'))
<p class="alert alert-success">{{ session('success') }}</p>
@endif
<div class="card card-default">
   {{-- @if(Auth::user()->level =='admin') --}}

   <div class="card-header">
      <form class="form-inline">
         <div class="form-group mr-1">
            <input class="form-control" type="text" name="q" value="{{ $q}}" placeholder="Pencarian..." />
         </div>
         <div class="form-group mr-1">
            <button class="btn btn-success">Refresh</button>
         </div>
         <div class="form-group mr-1">
            <a class="btn btn-primary" href="{{ route('tempatsampah.create') }}">Tambah</a>
         </div>
      </form>

   </div>
   {{-- @endif --}}
   <div class="card-body p-0 table-responsive">
      <table class="table table-bordered table-striped table-hover mb-0" id="myTable">
         <thead>
            <tr>
               <th onclick="sortTable(0)">No</th>
               <th onclick="sortTable(1)">ID Device</th>
               <th onclick="sortTable(2)">Alamat</th>
               <th onclick="sortTable(3)">Kota</th>
               <th onclick="sortTable(4)">Cluster</th>
               <th onclick="sortTable(5)">Latitude</th>
               <th onclick="sortTable(6)">Longitude</th>
               <th onclick="sortTable(7)">Penanggung Jawab</th>
               <th>Gambar</th>
               <th onclick="sortTable(8)">Status</th>
               <th onclick="sortTable(9)">Jenis Limbah</th>
               <th onclick="sortTable(10)">Aksi</th>
            </tr>
         </thead>
         <?php $no = 1 ?>
         @foreach($rows as $row)
         <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row->id_tempat_sampah }}</td>
            <td>{{ $row->alamat }}</td>
            <td>{{ $row->kota }}</td>
            <td>{{ $row->keterangan }}</td>
            <td>{{ $row->latitude }}</td>
            <td>{{ $row->longitude }}</td>
            <td>{{ $row->user->nama_user }}</td>
            <td><img src="{{ asset($row->foto_tempatsampah)}}" width="100"</td>
            <td>{{ $row->status }}</td>
            <td>{{ $row->jenis_limbah }}</td>
            <td>
               @if(Auth::user()->level =='admin')
               <a class="btn btn-sm btn-warning" href="{{ route('tempatsampah.edit', $row) }}">Ubah</a>
               {{-- <form method="POST" action="{{ route('tempatsampah.destroy', $row) }}" style="display: inline-block;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data?')">Hapus</button>
               </form> --}}
               @elseif ($row->user->nama_user == Auth::user()->nama_user)
               <form method="GET" action="{{url('update_distance')}}" style="display: inline-block;">
                  {{ csrf_field() }}
                  <input class="form-control" type="hidden" name="id_tempat_sampah"
                     value="{{ old('id_tempat_sampah', $row->id_tempat_sampah) }}" />


                  <button class="btn btn-sm btn-danger"
                     onclick="return confirm('Kosongkan Tempat Sampah?')">Kosongkan</button>
               </form>
               @endif
            </td>
         </tr>
         @endforeach
      </table>
      <div class="d-felx justify-content-center">
         {{ $rows->links() }}
      </div>
   </div>
</div>


<script>
   function sortTable(n) {
     var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
     table = document.getElementById("myTable");
     switching = true;
     // Set the sorting direction to ascending:
     dir = "asc";
     /* Make a loop that will continue until
     no switching has been done: */
     while (switching) {
       // Start by saying: no switching is done:
       switching = false;
       rows = table.rows;
       /* Loop through all table rows (except the
       first, which contains table headers): */
       for (i = 1; i < (rows.length - 1); i++) {
         // Start by saying there should be no switching:
         shouldSwitch = false;
         /* Get the two elements you want to compare,
         one from current row and one from the next: */
         x = rows[i].getElementsByTagName("TD")[n];
         y = rows[i + 1].getElementsByTagName("TD")[n];
         /* Check if the two rows should switch place,
         based on the direction, asc or desc: */
         if (dir == "asc") {
           if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
             // If so, mark as a switch and break the loop:
             shouldSwitch = true;
             break;
           }
         } else if (dir == "desc") {
           if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
             // If so, mark as a switch and break the loop:
             shouldSwitch = true;
             break;
           }
         }
       }
       if (shouldSwitch) {
         /* If a switch has been marked, make the switch
         and mark that a switch has been done: */
         rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
         switching = true;
         // Each time a switch is done, increase this count by 1:
         switchcount ++;
       } else {
         /* If no switching has been done AND the direction is "asc",
         set the direction to "desc" and run the while loop again. */
         if (switchcount == 0 && dir == "asc") {
           dir = "desc";
           switching = true;
         }
       }
     }
   }
   </script>
@endsection