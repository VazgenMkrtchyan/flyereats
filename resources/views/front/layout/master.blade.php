<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="{{ appCon()->meta_keyw }}">
    <meta name="description" content="@section('meta-description'){{ appCon()->meta_desc }}@show">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta-title', appCon()->web_name)</title>

    <!-- Open Graph Data (for FaceBook and Google+ Share)-->
    @yield('og-data')

            <!-- HEAD STYLES & SCRIPTS -->
    @include('front.layout.partials.css-scripts')

            <!-- For Additional CSS scripts -->
    @yield('additional-css')


            <!-- Live Reload -->
    @if (File::exists(base_path('LIVE_RELOAD')))
        <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
    @endif
     <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?5Y4ePBw8XbMp2PyWtx7wTzL3RqWnlZiK";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#252e39"
    },
    "button": {
      "background": "#e02b20"
    }
  },
  "position": "bottom-left"
})});
</script>
</head>
<body class="site">

@if (demo_mode_on())
    <div class="demo-info">
        {{ Form::open(['route' => 'misc.change_theme', 'id' => 'change_color_scheme']) }}
        <div class="form-group">
            {{ Form::select('color_scheme', [
            'default' => "Blue Theme",
            'green' => "Green Theme",
            'orange' => "Orange Theme",
            'pink' => "Pink Theme",
            'purple' => "Purple Theme",
            ], sessionOrWebc('color_scheme', 'color_scheme'), ['class' => 'form-control', 'id' => 'color_scheme']) }}
        </div>
        {{ Form::close() }}
        <div class="admin-panel">
            <a href="{{ route('admin.sessions.create') }}" target="_blank" class="btn-main" role="button">ADMIN PANEL</a>
        </div>
    </div>
@endif

@include('front.layout.partials.navbar')

@if(\Request::route()->getName() == 'index')
<section class="story section--slider-thingy">
        <!-- Form -->

            <!-- End of form -->

        <div class="homeSlider">
          <div class=""><img src="https://www.ipswichautos.co.uk/uploads/slider/ipswich-auto-slider.jpg" ></div>
            
        </div>
  <div class="title-Slider"></div>
         {{ Form::open(['route' => 'do_search', 'id' => 'quick-search']) }}

        <div class="index-quick-search">

            <div class="row upper-options">
                <div class="col-sm-8 no-sides-padding">
                    @foreach($details['Conditions'] as $id => $condition)
                        <label class="radio-inline">
                            <input type="radio" name="condition" id="carCond" value="{{ $id }}"> {{ $condition }}
                        </label>
                    @endforeach
                    <label class="radio-inline">
                        <input type="radio" name="condition" id="carCond" value="" checked> {{ trans('front.all') }}
                    </label>
                </div>
                <div class="col-sm-4 hidden-xs"><a href="{{ route('advanced-search.index') }}">{{ trans('front.advanced_search') }} <i class="fa fa-chevron-right"></i></a></div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="search-option">
                        {{ Form::select('make', [
                '' => trans('front.all_makes')
                ] + $details['Makes'], null, ['class'=>'form-control', 'id' => 'make']); }}
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="search-option">
                        {{ Form::select('model', [
                        '' => trans('front.all_models')
                        ], null, ['class'=>'form-control', 'id' => 'model']); }}
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="search-option">
                        {{ Form::select('max_price', [
                        '' => trans('front.no_max_price')
                        ] + rangePrice(), null, ['class'=>'form-control']); }}
                    </div>
                </div>

                <div class="col-lg-4 col-sm-4 no-sides-padding zip-range">
                    <div class="row">
                        <!--<div class="col-xs-6 range">
                            {{ Form::select('distance', [
                            '' => trans('front.all') . ' ' . mileageUnits()
                            ] + rangeDistance(), sessionOrDefault('distance'), ['class'=>'form-control']); }}
                        </div>-->
                        <div class="col-xs-6 zip">
                            <span>{{ trans('front.of') }}</span>
                            {{ Form::text('zip', sessionOrDefault('zip'), ['class'=>'form-control', 'placeholder' => 'Post Code']); }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-2 search-btn">
                    <button class="btn-main" type="submit">
                        {{ trans('front.SEARCH') }}
                    </button>
                </div>

            </div>

            <div class="adv-search visible-xs"><a href="{{ route('advanced-search.index') }}">{{ trans('front.advanced_search') }} <i class="fa fa-chevron-right"></i></a></div>

        </div>

        {{ Form::close() }}
</section>
@endif
<div class="container" id="site-content">

    <div class="logo-mobile">
        <a href="{{ route('index') }}"><img src="{{ asset( 'uploads/logos/'. (demo_mode_on() ? ('auto_' . sessionOrWebc('color_scheme', 'color_scheme') . '.png') : appCon()->logo) ) }}"></a>
    </div>

    <!-- SERVER SIDE VALIDATION ALERTS(almost never visible) -->
    @include('front.layout.partials.alert-validation-server-side')

            <!-- FLASH MESSAGES -->
    @include('front.layout.partials.flash-messages')

            <!-- #################  CONTENT GOES HERE  ################# -->
    @yield('content')

</div>

<!-- FOOTER -->
@include('front.layout.partials.footer')


        <!-- for modal elements-->
@yield('modals')


        <!-- SCRIPTS -->
@include('front.layout.partials.scripts')


        <!-- #################  FOR ADDITIONAL SCRIPTS (page specific plugin, inline scripts)  ################# -->
@yield('additional-scripts')
@yield('additional-scripts-2')

        <!-- GOOGLE ANALYTICS CODE -->
{{ appCon()->analytics_code }}

</body>
</html>