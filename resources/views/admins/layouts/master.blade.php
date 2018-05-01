<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Kami Kerja Remote">

    <meta name="author" content="Kami Kerja Remote">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" type="image/png" sizes="16x16" href="#">

    <title>Kami Kerja Remote</title>

    {!! Html::style('admins/css/bootstrap.min.css') !!}

    {!! Html::style('admins/css/sidebar-nav.min.css') !!}

    {!! Html::style('admins/css/animate.css') !!}

    {!! Html::style('admins/css/style.css') !!}

    {!! Html::style('admins/css/red-dark.css', array('id' => 'theme')) !!}

    {!! Html::style('admins/css/custom.css', array('id' => 'theme')) !!}

    {!! Html::style('admins/css/toastr.min.css') !!}

    {!! Html::style("https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css") !!}

    @stack("adminstyle")

</head>

<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>

<body class="fix-sidebar">
    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>

    <div id="wrapper">
        @include('admins.partials.navigation.top')
        @include('admins.partials.navigation.sidebar')

        <div id="page-wrapper" style="min-height: 611px;">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"> Kami Kerja Remote</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12 text-right">
                        @yield('btn-add-content')
                    </div>
                </div>
                
                @yield('admincontent')
            </div>

            <footer class="footer text-center"> {{ date('Y') }} &copy; Kami Kerja Remote </footer>
        </div>
    </div>

    {!! Html::script('admins/js/jquery.min.js') !!}

    {!! Html::script('admins/js/bootstrap.min.js') !!}

    {!! Html::script('admins/js/sidebar-nav.min.js') !!}

    {!! Html::script('admins/js/jquery.slimscroll.js') !!}

    {!! Html::script('admins/js/waves.js') !!}

    {!! Html::script('admins/js/custom.js') !!}
    
    {!! Html::script("https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js") !!}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.0/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>

    <script type="text/javascript">
    $(function (){
        FastClick.attach(document.body);
    });
    </script>

    @stack("adminscript")

</body>

</html>