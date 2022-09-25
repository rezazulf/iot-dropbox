@extends('app')
@section('content')
@if(session('success'))
<p class="alert alert-success">{{ session('success') }}</p>
@endif
<div class="card border-primary mb-3 mt-6">
   <div class="card-body text-primary">
      <h5 class="card-title">Smart Trash</h5>
      <p class="card-text">Selamat datang di dashboard {{ Auth::user()->level }}, {{ Auth::user()->nama_user }}!</p>
   </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<div class="card card-default">
   @if(Auth::user()->level =='admin')

   <div class="card-header">
      <form class="form-inline">
         <div class="form-group mr-1">
            <input class="form-control" type="text" name="q" value="{{ $q}}" placeholder="Pencarian..." />
         </div>
         <div class="form-group mr-1">
            <button class="btn btn-success">Refresh</button>
         </div>
      </form>

   </div>
   @endif
   <div class="card-body p-0 table-responsive">
      <table class="table table-bordered table-striped table-hover mb-0" id="myTable">
         <thead>
            <tr>
               <th onclick="sortTable(0)">No</th>
               <th onclick="sortTable(1)">Alamat</th>
               <th onclick="sortTable(2)">Latitude</th>
               <th onclick="sortTable(3)">Longitude</th>
               <th onclick="sortTable(4)">Level</th>
               <th onclick="sortTable(5)">Kapasitas</th>
               <th>Status</th>
            </tr>
         </thead>
         <?php $no = 1 ?>
         @foreach($rows as $row)
         <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $row->alamat }}</td>
            <td>{{ $row->latitude }}</td>
            <td>{{ $row->longitude }}</td>
            <td>{{ $row->distance }}%</td>
            <td>
               @if($row->distance >= '0' and $row->distance <=10)
               <P>Kosong</P>
               @endif
               @if($row->distance >= 90 and $row->distance <=100)
               <P>Penuh</P>
               @endif
               @if($row->distance > 10 and $row->distance < 90 ) 
               <P>Terisi</P>

                  @endif
            </td>
            <td>{{ $row->status }}</td>

         </tr>
         @endforeach
      </table>
      <div class="d-felx justify-content-center">
         {{ $rows->links() }}
      </div>
   </div>
</div>


<div class="container">
   <div class="row">
      <div class="col-md-10 offset-md-1">
         <div class="panel panel-default">
            <div class="panel-body">
               <canvas id="pie-chart" height="400" width="600"></canvas>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
$(function() {
   //get the pie chart canvas
   var cData = JSON.parse('<?php echo $chart_data; ?>');
   var ctx = $("#pie-chart");

   //pie chart data
   var data = {
      labels: cData.label,
      datasets: [{
         label: "Total Tong Sampah Di Reset ",
         data: cData.data,
         backgroundColor: [
            "#DEB887",
            "#A9A9A9",
            "#DC143C",
            "#F4A460",
            "#2E8B57",
            "#1D7A46",
            "#CDA776",
         ],
         borderColor: [
            "#CDA776",
            "#989898",
            "#CB252B",
            "#E39371",
            "#1D7A46",
            "#F4A460",
            "#CDA776",
         ],
         borderWidth: 1
      }]
   };

   //options
   var options = {
      responsive: true,
      title: {
         display: true,
         position: "top",
         text: "Data Pengosongan Sampah 1 Minggu Ke belakang",
         fontSize: 18,
         fontColor: "#111"
      },
      legend: {
         display: true,
         position: "bottom",
         labels: {
            fontColor: "#333",
            fontSize: 16
         }
      }
   };

   //create Pie Chart class object
   var chart1 = new Chart(ctx, {
      type: "bar",
      data: data,
      options: {
         scales: {
            xAxes: [{
               stacked: true
            }],
            yAxes: [{
               stacked: true
            }]
         }
      }
   });

});

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