@extends('depan')
@section('content')
@if(session('success'))
<p class="alert alert-success">{{ session('success') }}</p>
@endif

<style>
#login .container #login-row #login-column #login-box {
   margin-top: 10px;
   max-width: 600px;
   height: 320px;
   border: 1px solid #9C9C9C;
   background-color: #EAEAEA;
}

#login .container #login-row #login-column #login-box #login-form {
   padding: 20px;
}

#login .container #login-row #login-column #login-box #login-form #register-link {
   margin-top: -85px;
}
</style>
<div id="layoutAuthentication">
   <div id="layoutAuthentication_content">
      <main>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-5">
                  <div class="card shadow-lg border-0 rounded-lg mt-5">
                     {{-- Error Alert --}}
                     @if(session('error'))
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     @endif
                     <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Login</h3>
                     </div>
                     <div class="card-body">
                        <form action="{{url('proses_login')}}" method="POST" id="logForm">
                           {{ csrf_field() }}
                           <div class="form-group">
                              @error('login_gagal')
                              {{-- <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                              </span> --}}
                              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                 {{-- <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span> --}}
                                 <span class="alert-inner--text"><strong>Warning!</strong> {{ $message }}</span>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              @enderror
                              <label class="small mb-1" for="inputEmailAddress">Email</label>
                              <input class="form-control py-4" id="inputEmailAddress" name="email" type="email"
                                 placeholder="Masukkan Email" />
                              @if($errors->has('email'))
                              <p class="text-danger">{{ $errors->first('email') }}</p>
                              @endif
                           </div>
                           <div class="form-group">
                              <label class="small mb-1" for="inputPassword">Password</label>
                              <input class="form-control py-4" id="inputPassword" type="password" name="password"
                                 placeholder="Masukkan Password" />
                              @if($errors->has('password'))
                              <p class="text-danger">{{ $errors->first('password') }}</p>
                              @endif
                           </div>
                           <div class="form-group">
                              <div class="custom-control custom-checkbox">
                                 <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                 <label class="custom-control-label" for="rememberPasswordCheck">Remember
                                    password</label>
                              </div>
                           </div>
                           <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                              {{-- <a class="small" href="#">Forgot Password?</a> --}}
                              <button class="btn btn-primary btn-block" type="submit">Login</button>
                           </div>
                        </form>
                     </div>
                     <div class="card-footer text-center">
                        <div class="small">
                           {{-- <a href="{{url('register')}}">Belum Punya Akun? Daftar!</a> --}}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </main>
   </div>

</div>



@endsection