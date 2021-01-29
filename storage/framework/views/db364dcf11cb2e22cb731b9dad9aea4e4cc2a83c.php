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
        <?php echo trans('front.menu'); ?>

        <div class="close-icon">
            <i class="fa fa-times"></i>
        </div>
    </div>

    <div class="nav-wrapper">
        <div class="container">

            <?php if(appCon()->logo): ?>
                <div class="nav-logo">
                    <a href="<?php echo route('index'); ?>"><img src="<?php echo asset( 'uploads/logos/' . (demo_mode_on() ? ('auto_' . sessionOrWebc('color_scheme', 'color_scheme') . '.png') : appCon()->logo) ); ?>"></a>
                </div>
            <?php endif; ?>

            <div class="star-watch">
                <a href="<?php echo route('browselistings.index', ['show_loved' => 'true']); ?>" title="<?php echo trans('front.loved_listings'); ?>"><i class="fa fa-heart"></i></a>
                <a href="<?php echo route('browselistings.index', ['show_history' => 'true']); ?>" title="<?php echo trans('front.seen_listings'); ?>"><i class="fa fa-history"></i></a>
            </div>

            <div class="nav-menu">
                <ul class="menu">
                    <li data-li-identifier="index"><a href="<?php echo route('index'); ?>"><?php echo trans('front.home'); ?></a></li>

                    <li data-li-identifier="browselistings.index"><a href="<?php echo route('browselistings.index'); ?>">Stocklist</a></li>


                    <li data-li-identifier="pages.about-us"><a href="<?php echo route('pages.about-us'); ?>"><?php echo trans('front.about_us'); ?></a></li>
                     
                    <li data-li-identifier="pages.about-us"><a href="http://utaxitewkesbury.co.uk/brighton/sell-your-car"><?php echo trans('Sell Your Car'); ?></a></li>
                    <li data-li-identifier="pages.about-us"><a href="http://utaxitewkesbury.co.uk/brighton/part-exchange"><?php echo trans('Part Exchange'); ?></a></li>
                     <li data-li-identifier="contactus.index"><a href="<?php echo route('contactus.index'); ?>"><?php echo trans('front.contact_us'); ?></a></li>

                    <?php if(! Auth::guest()): ?>
                        <li class="has-sub">
                            <a href="#"><b><?php echo trans('front.dashboard'); ?></b></a>

                            <ul class="sub-menu">
                                <?php if(Auth::user()->isSimple()): ?>
                                       <li class="visible-lg" id="add-listing-nav">
                        <a href="<?php echo route('userlistings.create'); ?>"><i class="fa fa-plus-square"></i><?php echo trans('front.add_listing'); ?></a>
                    </li>
                                    <li data-li-identifier="account_summary"><a href="<?php echo route('account_summary'); ?>"><i class="fa fa-info-circle"></i> <?php echo trans('front.account_summary'); ?></a></li>
                                    <li data-li-identifier="profile.edit"><a href="<?php echo route('profile.edit'); ?>"><i class="fa fa-user"></i> <?php echo trans('front.edit_profile'); ?></a></li>
                                    <li data-li-identifier="userlistings.index"><a href="<?php echo route('userlistings.index'); ?>"><i class="fa fa-list"></i> <?php echo trans('front.manage_listings'); ?></a></li>
                                   
                                <?php else: ?>
                                    <li><a href="<?php echo route('admin.dashboard'); ?>" target="_blank"><b><i class="fa fa-cogs"></i> <?php echo trans('front.admin_panel'); ?></b></a></li>
                                <?php endif; ?>

                                <li><a href="<?php echo route('sessions.destroy'); ?>"><i class="fa fa-power-off"></i> <?php echo trans('front.log_out'); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                   <!-- <li class="visible-lg" id="add-listing-nav">
                        <a href="<?php echo route('userlistings.create'); ?>"><i class="fa fa-plus-square"></i><?php echo trans('front.add_listing'); ?></a>
                    </li>-->
                     
                    <li class="visible-xs visible-sm"><a href="<?php echo route('browselistings.index', ['show_loved' => 'true']); ?>"><i class="fa fa-heart"></i> <?php echo trans('front.loved_listings'); ?></a>
                    </li>
                    <li class="visible-xs visible-sm"><a href="<?php echo route('browselistings.index', ['show_history' => 'true']); ?>"><i class="fa fa-history"></i> <?php echo trans('front.seen_listings'); ?></a></li>
                </ul>
            </div>

        </div>
    </div>

</div>