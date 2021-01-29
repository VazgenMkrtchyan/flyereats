<!-- Fixed navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="color:#fff; font-size: 14px;font-family: 'Open Sans';"><i class="fa fa-phone"></i> Call us Today! 01753 290 720</a>
     <a class="navbar-brand" href="#" style="color:#fff; font-size: 14px;font-family: 'Open Sans';"> <i class="fa fa-map-marker"> London, UK</i></a>
    </div>
    
        
        
        
      <ul class="nav navbar-nav navbar-right">
          
         <i class="fa fa-facebook-square" style="margin-top: 19px;font-size: 20px;padding-right: 5px;"></i><a href="#" target="_blank"></a>
                  <i class="fa fa-twitter-square" style="margin-top: 19px; font-size: 20px;padding-right: 5px;"></i><a href="#" target="_blank"></a>
         <i class="fa fa-instagram" style="margin-top: 19px;font-size: 20px;padding-right: 5px;"></i><a href="#" target="_blank"></a>
         <i class="fa fa-youtube" style="margin-top: 19px;font-size: 20px;padding-right: 5px;"></i><a href="#" target="_blank"></a>
         
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<div class="header-master">

    <div class="space-filler-on-scroll"></div>

    <div class="nav-menu-toggle">
        {{ trans('front.menu') }}
        <div class="close-icon">
            <i class="fa fa-times"></i>
        </div>
    </div>

    <div class="nav-wrapper">
        <div class="container">

            @if (appCon()->logo)
                <div class="nav-logo">
                    <a href="{{ route('index') }}"><img src="{{ asset( 'uploads/logos/' . (demo_mode_on() ? ('auto_' . sessionOrWebc('color_scheme', 'color_scheme') . '.png') : appCon()->logo) ) }}"></a>
                </div>
            @endif

            <div class="star-watch">
                <a href="{{ route('browselistings.index', ['show_loved' => 'true']) }}" title="{{ trans('front.loved_listings') }}"><i class="fa fa-heart"></i></a>
                <a href="{{ route('browselistings.index', ['show_history' => 'true']) }}" title="{{ trans('front.seen_listings') }}"><i class="fa fa-history"></i></a>
            </div>

            <div class="nav-menu">
                <ul class="menu">
                    <li data-li-identifier="index"><a href="{{ route('index') }}">{{ trans('front.home') }}</a></li>

                    <li data-li-identifier="browselistings.index"><a href="{{ route('browselistings.index') }}">Stocklist</a></li>


                    <li data-li-identifier="pages.about-us"><a href="{{ route('pages.about-us') }}">{{ trans('front.about_us') }}</a></li>
                     
                    <li data-li-identifier="pages.about-us"><a href="http://utaxitewkesbury.co.uk/brighton/sell-your-car">{{ trans('Sell Your Car') }}</a></li>
                    <li data-li-identifier="pages.about-us"><a href="http://utaxitewkesbury.co.uk/brighton/part-exchange">{{ trans('Part Exchange') }}</a></li>
                     <li data-li-identifier="contactus.index"><a href="{{ route('contactus.index') }}">{{ trans('front.contact_us') }}</a></li>

                    @if (! Auth::guest())
                        <li class="has-sub">
                            <a href="#"><b>{{ trans('front.dashboard') }}</b></a>

                            <ul class="sub-menu">
                                @if (Auth::user()->isSimple())
                                       <li class="visible-lg" id="add-listing-nav">
                        <a href="{{ route('userlistings.create') }}"><i class="fa fa-plus-square"></i>{{ trans('front.add_listing') }}</a>
                    </li>
                                    <li data-li-identifier="account_summary"><a href="{{ route('account_summary') }}"><i class="fa fa-info-circle"></i> {{ trans('front.account_summary') }}</a></li>
                                    <li data-li-identifier="profile.edit"><a href="{{ route('profile.edit') }}"><i class="fa fa-user"></i> {{ trans('front.edit_profile') }}</a></li>
                                    <li data-li-identifier="userlistings.index"><a href="{{ route('userlistings.index') }}"><i class="fa fa-list"></i> {{ trans('front.manage_listings') }}</a></li>
                                   
                                @else
                                    <li><a href="{{ route('admin.dashboard') }}" target="_blank"><b><i class="fa fa-cogs"></i> {{ trans('front.admin_panel') }}</b></a></li>
                                @endif

                                <li><a href="{{ route('sessions.destroy') }}"><i class="fa fa-power-off"></i> {{ trans('front.log_out') }}</a></li>
                            </ul>
                        </li>
                    @endif

                   <!-- <li class="visible-lg" id="add-listing-nav">
                        <a href="{{ route('userlistings.create') }}"><i class="fa fa-plus-square"></i>{{ trans('front.add_listing') }}</a>
                    </li>-->
                     
                    <li class="visible-xs visible-sm"><a href="{{ route('browselistings.index', ['show_loved' => 'true']) }}"><i class="fa fa-heart"></i> {{ trans('front.loved_listings') }}</a>
                    </li>
                    <li class="visible-xs visible-sm"><a href="{{ route('browselistings.index', ['show_history' => 'true']) }}"><i class="fa fa-history"></i> {{ trans('front.seen_listings') }}</a></li>
                </ul>
            </div>

        </div>
    </div>

</div>