<!doctype html>
<html lang="en">
<link rel="icon" href="{{ url('/image/favicon.png') }}">
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


   <style type="text/css">
   #mymap {
      border: 1px solid red;
      width: 800px;
      height: 500px;
   }
   </style>
   <title>@yield('title', $title)</title>
</head>

<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="#">Smart Trash</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
         aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
         <div class="navbar-nav">
            <a class="nav-link" {{  request()->routeIs('home.*') ? 'active' : '' }} href="home">Home <span
                  class="sr-only">(current)</span></a>
            @if(Auth::user()->level =='admin')
            <a class="nav-link {{  request()->routeIs('grafik.*') ? 'active' : '' }}" href="grafik">Grafik</a>
            <a class="nav-link {{  request()->routeIs('user.*') ? 'active' : '' }}" href="user">User</a>
            <a class="nav-link {{  request()->routeIs('tempatsampah.*') ? 'active' : '' }}" href="tempatsampah">Tempat
               Sampah</a>
            <a class="nav-link {{  request()->routeIs('map.*') ? 'active' : '' }}" href="map">Peta</a>
            @else
            <a class="nav-link {{  request()->routeIs('map.*') ? 'active' : '' }}" href="peta">Peta</a>
            <a class="nav-link {{  request()->routeIs('kosongkansampah.*') ? 'active' : '' }}"
               href="kosongkansampah">Kosongkan
               Tempat
               Sampah</a>
            @endif
            <a class="nav-link" href="{{url('logout')}}">Logout</a>




         </div>
      </div>
   </nav>
   <div class="container-fluid">
      <div class="card  mt-4">
         <div class="card-body">
            <h3>@yield('title', $title)</h3>
            @yield('content')
         </div>
      </div>
   </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
   integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


</html>