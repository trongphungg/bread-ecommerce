<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('customer/assets/img/banner-fruits.jpg') }}" class="link-icon">
    <title>Bánh mì Phong Hiền</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Css --}}
    <link href="{{ asset ('customer/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('customer/assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="{{asset('customer/assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    {{-- Introjs --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js/minified/introjs.min.css">
</head>
<body>
    @include('customer.components.header')
    <div style="padding-top:100px;">
        @yield('content')
    </div>
    @include('customer.components.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{asset ('customer/assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset ('customer/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Introjs --}}
    <script src="https://cdn.jsdelivr.net/npm/intro.js/minified/intro.min.js"></script>
</body>
</html>