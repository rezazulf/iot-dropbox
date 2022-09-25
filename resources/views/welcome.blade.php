@extends('depan')
@section('content')
@if(session('success'))
<p class="alert alert-success">{{ session('success') }}</p>
@endif

<style>
#map {
   height: 500px;
   width: 100%;
}
</style>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<div class="card border-primary mb-3 mt-6">
   <div class="card-body text-primary">
      <h5 class="card-title">Peta Penyebaran Tempat Sampah</h5>
      <div id="map"></div>


   </div>
</div>
<script type="text/javascript">
var lg = "";
var lt = "";
var locations = <?php print_r(json_encode($rows)) ?>;
initGeolocation();

function initGeolocation() {
   if (navigator.geolocation) {
      // Call getCurrentPosition with success and failure callbacks
      navigator.geolocation.getCurrentPosition(success, fail);
   } else {
      alert("Sorry, your browser does not support geolocation services.");
   }
}

function success(position) {

   lg = position.coords.longitude;
   lt = position.coords.latitude



   var mymap = new GMaps({
      el: '#map',
      lat: lt,
      lng: lg,
      zoom: 12
   });


   $.each(locations, function(index, value) {
      mymap.addMarker({
         lat: value.latitude,
         lng: value.longitude,
         icon: "{{url('/image/trash.png')}}",
         title: value.name,
         click: function(e) {
            if ((value.distance >= 0) && (value.distance <= 10)) {
               var stat = 'Kosong';
            }
            if ((value.distance >= 90) && (value.distance <= 100)) {
               var stat = 'Penuh';
            }
            if ((value.distance > 10) && (value.distance < 90)) {
               var stat = 'Terisi';
            }
            $('#nama_tmpt').text('Lokasi : ' + value.alamat);
            $('#status').text('Status : ' + value.status);
            $('#kapasitas').text('Kapasitas : ' + stat);
            $('#level').text('Level : ' + value.distance+'%');

            $('#staticBackdrop').modal('show');
            //   alert('Nama Lokasi ' + value.name + ' Kapasitas ' + status);
         }
      });
   });
}

function fail() {
   // Could not obtain location
}
</script>


<div class="modal fade" id="staticBackdrop" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Detail tempat sampah</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p>
            <div id="nama_tmpt"></div>
            </p>
            <p>
            <div id="status"></div>
            </p>
            <p>
            <div id="kapasitas"></div>
            </p>
            <p>
            <div id="level"></div>
            </p>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
@endsection