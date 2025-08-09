<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('customer/assets/img/banner-fruits.jpg') }}" class="link-icon">
    <title>Trang quản trị</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}" />
        {{-- Toast --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{asset('admin/assets/css/plugins.min.css')}}" /> --}}
    <link rel="stylesheet" href="{{asset('admin/assets/css/kaiadmin.min.css')}}" />


<script src="{{asset('admin/assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{asset('admin/assets/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

   
</head>

<body>
     <div class="wrapper">
        @include('admin.components.sidebar')
      <div class="main-panel">
        @include('admin.components.header')
        <div class="container">
          @yield('content')
        </div>
      </div>
   

      {{-- Sweet alert --}}
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    {{-- <script src="{{ asset('admin/assets/js/kaiadmin.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Toast --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</body>

</html>
