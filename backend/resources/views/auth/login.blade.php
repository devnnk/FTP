<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/victory/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 Jun 2020 15:43:18 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{config('custom.app_name')}}</title>
  <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/flag-icon-css/css/flag-icon.min.css')}} ">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('admin/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth">
          <div class="row w-100">
            <div class="col-lg-8 mx-auto">
              <div class="row">
                <div class="col-lg-6 bg-white">
                  <div class="auth-form-light text-left p-5">
                    <h2>Login</h2>
                    <h4 class="font-weight-light">Hello! let's get started</h4>
                    <form class="pt-5" method="POST" action="{{ route('login') }}">
                      <form>
                        @csrf
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          <i class="mdi mdi-account"></i>
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" name=password id="password" placeholder="Password">
                          <i class="mdi mdi-eye"></i>
                        </div>
                        @if(session('key'))
                         <div class="alert alert-danger">
                             {{session('key')}}
                         </div>
                        @endif
                        <div class="mt-5">
                            <button type="submit" class="btn btn-block btn-warning btn-lg font-weight-medium">
                                {{ __('Login') }}
                            </button>
                            <a class="btn btn-block btn-success btn-lg font-weight-medium" href="{{ url('/auth/redirect/facebook') }}">Login with facebook</a>
                        </div>
                        <div class="mt-3 text-center">
                          {{-- <a href="#" class="auth-link text-black">Forgot password?</a> --}}
                          @if (Route::has('password.request'))
                                <a class="{{-- btn btn-link  --}}auth-link text-black" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                      </form>                  
                    </form>
                  </div>
                </div>
                <div class="col-lg-6 login-half-bg d-flex flex-row">
                  <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('admin/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{asset('admin/js/off-canvas.js')}}"></script>
  <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('admin/js/misc.js')}}"></script>
  <script src="{{asset('admin/js/settings.js')}}"></script>
  <script src="{{asset('admin/js/todolist.js')}}"></script>
  <!-- endinject -->
</body>
</html>
