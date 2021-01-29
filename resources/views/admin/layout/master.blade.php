<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>@yield('meta-title')</title>

    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ADDITIONAL STYLES -->
    @yield('additional-css-before')
            <!-- ################# HEAD SCRIPTS AND STYLES ################# -->
    @include('admin.layout.partials.css-scripts')

            <!-- Live Reload -->
    @if (File::exists(base_path('LIVE_RELOAD')))
        <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
        @endif

                <!-- ADDITIONAL STYLES -->
        @yield('additional-css')

</head>

<body class="no-skin">

<!-- #################  NAVBAR GOES HERE  ################# -->
@include('admin.layout.partials.navbar')

<div class="main-container" id="main-container">

    <!-- #################  SIDEBAR GOES HERE  ################# -->
    @include('admin.layout.partials.sidebar')

            <!-- #################  PAGE CONTENT GOES HERE  ################# -->
    <div class="main-content">
        <div class="page-content">
            <!-- SERVER SIDE VALIDATION ALERTS -->
            @include('admin.layout.partials.alert-validation-server-side')

                    <!-- DEMO MODE -->
            @if(demo_mode_on())
                <div class="alert alert-warning">
                    Website is in <strong>Demo Mode</strong>. All changes are disabled!
                </div>
                @endif

                        <!-- FLASH MESSAGES -->
                @include('admin.layout.partials.flash-messages')
                        <!-- PAGE CONTENT -->
                @yield('page-content')
        </div>
    </div>


    <!-- #################  FOOTER GOES HERE  ################# -->
    @include('admin.layout.partials.footer')

            <!-- for modal elements-->
    @yield('modals')

            <!-- ICON for 'MOVING UP' -->
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>

</div><!-- /.main-container -->

<!-- for dynamic JavaScript Variables Inclusion -->
@include('helpers.JSVariables')
        <!-- #################  MAJOR (BASIC) SCRIPTS GOES HERE  ################# -->
@include('admin.layout.partials.scripts')

        <!-- #################  FOR ADDITIONAL SCRIPTS (page specific plugins, inline scripts)  ################# -->
@yield('additional-scripts')
@yield('additional-scripts-2')

</body>
</html>