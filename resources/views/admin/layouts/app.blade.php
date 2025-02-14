<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
    <title>CHTS Admin - @yield('title')</title>
    {{-- <meta name="description" content="CHTS Admin - HTML5 Admin Template"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="{{ url('assets/css/cdn_css/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/cdn_css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/fonts/font_awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/fonts/themify/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/fonts/pixeden/pe-icon-7-stroke.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/fonts/flag_icon/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ url('assets/css/cdn_css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/cdn_css/jqvmap.min.css') }}">

    <link rel="stylesheet" href="{{ url('assets/css/cdn_css/weather-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/cdn_css/fullcalendar.min.css') }}">
    
    {{-- toster css --}}
    <link rel="stylesheet" href="{{ url('assets/css/toaster.css') }}">

    {{-- select 2 js --}}
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>

    {{-- select 2 css --}}
    <link rel="stylesheet" href="{{ url('assets/select2/select2.min.css') }}">
    
    <style>
        /* for tab padding */
        .nav-padding {
            padding: 10px 15px !important;
        }

        /* for auto * required when input required */
        label.required-label:after {
            content: "*";
            color: red;
            margin-left: 3px;
        }
    </style>
    @yield('css')
</head>

<body class="@if (!Auth::check()) bg-dark @endif">
    <!-- Right Panel -->
    @auth
        <!-- Include Sidebar -->
        @include('admin.layouts.partials.sidebar')
        <div id="right-panel" class="right-panel">
            <!-- Include header -->
            @include('admin.layouts.partials.header')

            <!-- Content -->
            @yield('content')

            <div class="clearfix"></div>

            <!-- Include Footer -->
            @include('admin.layouts.partials.footer')
        </div>
    @endauth

    @guest
        <!-- Only Content for Login Page -->
        @yield('content')
    @endguest
{{-- 
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
--}}
    <script src="{{ url('assets/js/cdn_js/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/cdn_js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ url('assets/js/cdn_js/jquery.matchHeight.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/js/main.js') }}"></script> --}}

    <!--  Chart js -->
    <script src="{{ url('assets/js/cdn_js/Chart.bundle.min.js') }}"></script>

    <!--Chartist Chart-->
    <script src="{{ url('assets/js/cdn_js/chartist.min.js') }}"></script>
    <script src="{{ url('assets/js/cdn_js/chartist-plugin-legend.min.js') }}"></script>

    {{-- <script src="{{ url('assets/js/cdn_js/jquery.flot.min.js') }}"></script>
    <script src="{{ url('assets/js/cdn_js/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ url('assets/js/cdn_js/jquery.flot.spline.min.js') }}"></script> --}}


    <script src="{{ url('assets/js/cdn_js/moment.min.js') }}"></script>
    <script src="{{ url('assets/js/cdn_js/fullcalendar.min.js') }}"></script>
    <script src="{{ url('assets/js/init/fullcalendar-init.js') }}"></script>
    <script src="{{ url('assets/js/cdn_js/sweetalert2@11.js') }}"></script>

    {{-- select 2 js --}}
    <script src="{{ url('assets/select2/select2.min.js') }}"></script>
  
    <!-- toster js -->
    <script src="{{ url('assets/js/toaster.js') }}"></script>    
    <script>
        $(document).ready(function() {
            console.log("jQuery is working!");
        });
    </script>
    <script>
        $(document).ready(function() {
            $(
                "input[required], select[required], textarea[required], input[type='checkbox'][required], input[type='radio'][required]"
            ).each(function() {
                var $label = $('label[for="' + $(this).attr("id") + '"]');

                $label.addClass("required-label");
            });
        });
    </script>

    <!-- delete confirm -->
    <script type="text/javascript">
        $('.delete').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Do it!'
                })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {

                        form.submit();

                    }
                });
        });
    </script>

    <!-- toster alert -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("Success", "{{ session('success') }}", "success");
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("Error", "{{ session('error') }}", "error");
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("Warning", "{{ session('warning') }}", "warning");
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("Info", "{{ session('info') }}", "info");
            });
        </script>
    @endif

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showToast("error", "{{ $error }}", "error");
                });
            </script>
        @endforeach
    @endif

    <!-- select 2 -->
    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });
    </script>

    @stack('js')
</body>

</html>
