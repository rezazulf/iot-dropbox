@extends('app')
@section('content')
@if(session('success'))
<p class="alert alert-success">{{ session('success') }}</p>
@endif

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

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
</script>

@endsection