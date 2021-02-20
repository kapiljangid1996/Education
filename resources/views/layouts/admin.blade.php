<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" href="favicon.ico">
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('AdminDesign/css/simplebar.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('AdminDesign/css/feather.css')}}">
    <link rel="stylesheet" href="{{asset('AdminDesign/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('AdminDesign/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('AdminDesign/css/uppy.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminDesign/css/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{asset('AdminDesign/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('AdminDesign/css/quill.snow.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('AdminDesign/css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('AdminDesign/css/app-light.css')}}" id="lightTheme">
    <link rel="stylesheet" href="{{asset('AdminDesign/css/app-dark.css')}}" id="darkTheme" disabled>
    <link href="{{ asset('AdminDesign/vendors/DataTables/datatables.min.css') }}" rel="stylesheet" />
    <style>
        .breadcrumb
        {
            background: white;
        }
    </style>
</head>
<body class="vertical light">
    <div class="wrapper">
        <!-- Seetalert-->
        @include('sweetalert::alert')
        <!--Sweetalert End-->
        
        <!-- Header -->
        @include('partials.header')
        <!-- Header End -->

        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- Sidebar End -->

        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        @yield('breadcrumb')
                        @include('partials.flash')
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
        
    <input type="hidden" id="base_url" name="base_url" value="{{ URL::to('/') }}">
    </div>

    <!-- Script -->
    <script src="{{asset('AdminDesign/js/jquery.min.js')}}"></script>    
    <script src="{{ asset('AdminDesign/vendors/DataTables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('AdminDesign/js/popper.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/moment.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/simplebar.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/daterangepicker.js')}}"></script>
    <script src="{{asset('AdminDesign/js/jquery.stickOnScroll.js')}}"></script>
    <script src="{{asset('AdminDesign/js/tinycolor-min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/d3.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/topojson.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/datamaps.all.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/datamaps-zoomto.js')}}"></script>
    <script src="{{asset('AdminDesign/js/datamaps.custom.js')}}"></script>
    <script src="{{asset('AdminDesign/js/Chart.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/gauge.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/jquery.mask.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/select2.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/jquery.steps.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/jquery.timepicker.js')}}"></script>
    <script src="{{asset('AdminDesign/js/dropzone.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/uppy.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/quill.min.js')}}"></script>
    <script src="{{asset('AdminDesign/js/apps.js')}}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <link rel="stylesheet" href="{{asset('AdminDesign/drag_drop_menu/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')}}">
    <script type="text/javascript" src="{{asset('AdminDesign/drag_drop_menu/jquery-menu-editor.js')}}"></script>
    <script type="text/javascript" src="{{asset('AdminDesign/drag_drop_menu/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js')}}"></script>
    <script>
        $("document").ready(function(){
            setTimeout(function(){
               $("div.alert").remove();
            }, 4000 ); // 4 secs
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $('#example-table').DataTable({
                pageLength: 10,
            });
        })
    </script>
    <script type="text/javascript">
        $("#name").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $("#slug").val(Text);
        });
    </script>
</body>
</html>