<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta-title', 'Script Installation Wizard')</title>

    <!-- HEAD STYLES & SCRIPTS -->
    @include('front.layout.partials.css-scripts')

    <!-- For Additional CSS scripts -->
    @yield('additional-css')

    <!-- Live Reload -->
    @if (getenv('LIVE_RELOAD') == 'true')
        <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
    @endif

</head>
<body>

<div class="container" id="installation-wizard">

    <!-- SERVER SIDE VALIDATION ALERTS(almost never visible) -->
    @include('front.layout.partials.alert-validation-server-side')

    <!-- FLASH MESSAGES -->
    @include('front.layout.partials.flash-messages')

    <!-- #################  CONTENT GOES HERE  ################# -->
    @yield('content')

</div>

<!-- SCRIPTS -->
@include('front.layout.partials.scripts')


 <!-- #################  FOR ADDITIONAL SCRIPTS (page specific plugin, inline scripts)  ################# -->
@yield('additional-scripts')
@yield('additional-scripts-2')

</body>
</html>