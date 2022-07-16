<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Unity</title>
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        {{-- @notifyCss --}}
        <style>
            .profileimg {
                height: 100px;
                width: 100px;
                border-radius: 50%;
            }

            .field-icon {
                float: right;
                margin-left: -25px;
                margin-top: -25px;
                position: relative;
                z-index: 2;
            }
        </style>
         <!-- Styles -->
         <link href="{{ asset('backend-asset/facebookreaction.css') }}" rel="stylesheet">
         <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- main style -->
        <link rel="stylesheet" href="{{ asset('backend-asset/main.css')}}" />
        <link rel="stylesheet" href="{{ asset('backend-asset/profilepic/profilepic.css')}}" />

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('backend-asset/plugins/toastr/toastr.min.css') }}">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('backend-asset/dist/css/adminlte.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet"
            href="{{ asset('backend-asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('backend-asset/plugins/daterangepicker/daterangepicker.css')}}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('backend-asset/plugins/summernote/summernote-bs4.min.css')}}">
    </head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <a style="color: #5bc0de; font-size: 35px;font-weight: bold;"
                            href="{{ url('home') }}">UNITY</a>
                    </ul>
                    <marquee style="color: #17a2b8; font-size: 35px;font-weight: bold;">WELCOME TO UNITY</marquee>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else (Auth::user()->profile_img)
                        <a href="{{ route('mypost') }}" class="dropdown-item p-1 rounded d-flex" type="button">
                            <img href="#" src="{{ setImage(auth()->user()->profile_img,'') }}"
                                style="width:50px; height:50px; border-radius:50%;">
                            <div>
                                <p class="m-0">{{auth()->user()->name}}</p>
                                <p class="m-0 text-muted">See your profile</p>
                            </div>
                        </a>
                        <li class="nav-item dropdown">
                            <a class="rounded-circle p-1 d-flex align-items-center justify-content-center mx-2 show"
                                style="width: 50px; height: 50px; background-color: rgb(204, 202, 202)" type="button"
                                id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    {{ __('View Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('updateprofile') }}">
                                    {{ __('Update Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('updatepassword') }}">
                                    {{ __('Update Password') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
</body>
<script src="{{ asset('js/app.js') }}"></script>
@notifyJs
<x:notify-messages />

    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script src="{{ asset('backend-asset/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend-asset/plugins/jquery-ui/jquery-ui.min.js')}}"> </script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- SweetAlert2 -->
<script src="{{ asset('backend-asset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('backend-asset/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('backend-asset/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend-asset/dist/js/adminlte.js')}}"></script>
{{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}">
</script> --}}
<script src="{{ asset('backend-asset/main.js')}}"></script>
<script src="{{ asset('backend-asset/profilepic/profilepic.js')}}"></script>


<script>
    @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }
        @endif 
</script>
<script>
    $(document).ready(function(){
        $('input[type="icon"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".section").not(targetBox).hide();
            $(targetBox).show();
        });
    });

    $(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
    });
     $(".toggle-confirmpassword").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
    });
</script>
@stack('script')


</html>