<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link rel="icon" href="favicon.ico">
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('AdminDesign/css/simplebar.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('AdminDesign/css/feather.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('AdminDesign/css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('AdminDesign/css/app-light.css')}}" id="lightTheme">
    <link rel="stylesheet" href="{{asset('AdminDesign/css/app-dark.css')}}" id="darkTheme" disabled>
</head>
<body class="light">
    <!-- Seetalert-->
    @include('sweetalert::alert')
    <!--Sweetalert End-->
    <div class="container" style="margin-top: 7%">      
        @include('partials.flash')
        @yield('auth')      
    </div>
    <!-- Script -->
    <script src="{{asset('AdminDesign/js/jquery.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/popper.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/moment.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/simplebar.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/daterangepicker.js')}}"></script>
    <script src="{{asset('AdminDesign/js/jquery.stickOnScroll.js')}}"></script>
    <script src="{{asset('AdminDesign/js/tinycolor-min.js')}}"></script>
    <script>
        $("document").ready(function(){
            setTimeout(function(){
               $("div.alert").remove();
            }, 4000 ); // 4 secs
        });
    </script>
</body>
</html>