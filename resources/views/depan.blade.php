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
   .dropdown-menu li{
    background:#FFF ;
   }
   .dropdown-menu li:hover{
      background:#dedede  !important;
   }
   
   </style>
   <title>Smart Trash</title>
</head>

<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="/">Smart Trash</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
         aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
         <ul class="navbar-nav">
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Peta
               </a>   
                  <ul class="dropdown-menu nav-fill w-100 bg-primary text-white" aria-labelledby="navbarDropdownMenuLink">
                  <li>
                  <a class="nav-link{{  request()->routeIs('/') ? 'active' : '' }} bg-primary text-white" href="/">Limbah Medis <span
                        class="sr-only">(current)</span></a>
                  </li>
                  <li>
                  <a class="nav-link{{  request()->routeIs('non-medis') ? 'active' : '' }} bg-primary text-white" href="non-medis">Limbah Umum <span
                     class="sr-only">(current)</span></a>
                  </li>
                  </ul>
               </li>
            <a class="nav-link{{  request()->routeIs('Login.*') ? 'active' : '' }}" href="login">Login <span
               class="sr-only">(current)</span></a>
         </ul>
      </div>
   </nav>
   <div class="container-fluid">
      <div class="card  mt-4">
         <div class="card-body">
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