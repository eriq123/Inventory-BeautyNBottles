<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="Beauty N Bottles Stock Management">
    <meta name="author" content="Karen Calulo Eriq John Mendoza">
    <meta name="keywords" content="Beauty N Bottles Stock Management">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Title Page-->
    <!-- <title>Dashboard</title> -->

    <!-- Fontfaces CSS-->
    <link href="{{asset('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    @yield('css')
    <!-- <link href="{{asset('vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" > -->
    <link href="{{asset('vendor/bootstrap-413/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Vendor CSS-->
    <!-- <link href="{{asset('vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all"> -->
   <!--  <link href="{{asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all"> -->

    <!-- Main CSS-->
    <link href="{{asset('css/theme.css')}}" rel="stylesheet" media="all">
    <style >
        @media only screen and (min-width:1024px){
            #MenuToHide {
                display: none;
            }
        }
        .logos {
            background-color: #ff55ff!important;
        }
        .asterisk {
            color:red;
        }
        .ImageContainer{
            width: 200px;
            height: 150px;
        }
    </style>
</head>

<body class="">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
            @include('partials.sidebar')
        </aside>

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            @include('partials.sidebar')
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            @include('partials.header-desktop')
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    @yield('content')
                </div>
            </div>
            
            <!-- END MAIN CONTENT-->
            @yield('modal')
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <!-- <script src="{{asset('vendor/jquery-3.2.1.min.js')}}"></script> -->
    <script src="{{asset('vendor/jquery-3.3.1.js')}}"></script>

    <!-- Bootstrap JS-->
<!--     <script src="{{asset('vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-4.1/bootstrap.min.js')}}"></script> -->
    <script src="{{asset('vendor/bootstrap-413/popper.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-413/bootstrap.min.js')}}"></script>
    
    <!-- Vendor JS       -->
   <!--  <script src="{{asset('vendor/slick/slick.min.js')}}"></script>
    <script src="{{asset('vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <script src="{{asset('vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('vendor/counter-up/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script> -->

    <!-- Main JS-->
    <script src="{{asset('js/main.js')}}"></script>
    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
    @yield('Js')
</body>

</html>
<!-- end document-->
