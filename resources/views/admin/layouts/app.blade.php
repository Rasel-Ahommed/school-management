<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
    <title>Ela Admin - @yield('title')</title>
    {{-- <meta name="description" content="Ela Admin - HTML5 Admin Template"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ url('assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    
    {{-- toster css --}}
    <link rel="stylesheet" href="{{url('assets/css/toaster.css')}}">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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


    <!-- Scripts -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="{{ url('assets/js/init/fullcalendar-init.js') }} "></script>

    <!-- toster js -->
    <script src="{{url('assets/js/toaster.js')}}"></script>
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


    @stack('js')
</body>

</html>
