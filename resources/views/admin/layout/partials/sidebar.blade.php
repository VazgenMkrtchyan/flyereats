<div id="sidebar" class="sidebar navbar-collapse collapse">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    <ul class="nav nav-list">

        <li class="" data-li-top="dashboard">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-dashboard"></i>
                <span class="menu-text"> {{ trans('back.dashboard') }} </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">
                <li class="" data-li-identifier="admin.dashboard">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        {{ trans('back.overview') }}
                    </a>
                    <b class="arrow"></b>
                </li>

                @if (Auth::user()->isSuper())
                    <li class="" data-li-identifier="admin.statistics.index">
                        <a href="{{ route('admin.statistics.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.website_statistics') }}
                        </a>
                        <b class="arrow"></b>
                    </li>
                @endif


                <li class="" data-li-identifier="admin.profile.edit">
                    <a href="{{ route('admin.profile.edit') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        {{ trans('back.your_profile') }}
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

@if (Auth::user()->hasPermissionsInGroup('listings'))
            <li class="" data-li-top="listings">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> {{ trans('back.listings') }} </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>


                <ul class="submenu">

                    @if (Auth::user()->hasPermission('admin.listings.index'))
                        <li class="" data-li-identifier="admin.listings.index">
                            <a href="{{ route('admin.listings.index') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                {{ trans('Manage Stocklist') }}
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif


                    @if (Auth::user()->hasPermission('admin.listings.create'))
                        <li class="" data-li-identifier="admin.listings.create">
                            <a href="{{ route('admin.listings.create') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                {{ trans('back.add_listing') }}
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif

                </ul>

            </li>
        @endif

        


        



        @if (Auth::user()->IsSuper())
            <li class="" data-li-top="administrators">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-male"></i>
                    <span class="menu-text"> {{ trans('back.administrators') }} </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">

                    <li class="" data-li-identifier="admin.administrators.index">
                        <a href="{{ route('admin.administrators.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.manage_administrators') }}
                        </a>
                        <b class="arrow"></b>
                    </li>


                    <li class="" data-li-identifier="admin.administrators.create">
                        <a href="{{ route('admin.administrators.create') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.add_administrator') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
        @endif



        @if (Auth::user()->hasPermissionsInGroup('users'))
            <li class="" data-li-top="users"  style="display:none;">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-user"></i>
                    <span class="menu-text"> {{ trans('back.users') }} </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">

                    @if (Auth::user()->hasPermission('admin.users.index'))
                        <li class="" data-li-identifier="admin.users.index" style="display:none;">
                            <a href="{{ route('admin.users.index') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                {{ trans('back.manage_users') }}
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif


                    @if (Auth::user()->hasPermission('admin.user-groups.index'))
                        <li class="" data-li-identifier="admin.user-groups.index"  style="display:none;">
                            <a href="{{ route('admin.user-groups.index') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                {{ trans('back.manage_user_groups') }}
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif


                    @if (Auth::user()->hasPermission('admin.users.create'))
                        <li class="" data-li-identifier="admin.users.create"  style="display:none;">
                            <a href="{{ route('admin.users.create') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                {{ trans('back.add_user') }}
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif

                </ul>
            </li>
        @endif



        @if (Auth::user()->hasPermissionsInGroup('company-profiles'))
            <li class="" data-li-top="company-profiles" style="display:none;">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-briefcase"></i>
                    <span class="menu-text"> {{ trans('back.company_profiles') }} </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">

                    @if (Auth::user()->hasPermission('admin.company-profiles.index'))
                        <li class="" data-li-identifier="admin.company-profiles.index">
                            <a href="{{ route('admin.company-profiles.index') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                {{ trans('back.manage_companies') }}
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif


                    @if (Auth::user()->hasPermission('admin.company-profiles.create'))
                        <li class="" data-li-identifier="admin.company-profiles.create">
                            <a href="{{ route('admin.company-profiles.create') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                {{ trans('back.add_company_profile') }}
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif

                </ul>

            </li>
        @endif



        @if (Auth::user()->IsSuper())
            <li class="" data-li-top="data-fields">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list-alt"></i>
                    <span class="menu-text"> Settings </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="" data-li-identifier="admin.data_features.index">
                        <a href="{{ route('admin.data_features.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.vehicle_features') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.data_makes.index">
                        <a href="{{ route('admin.data_makes.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.makes_models') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.data_solo.conditions">
                        <a href="{{ route('admin.data_solo.index', 'conditions') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.conditions') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.data_solo.bodyStyles">
                        <a href="{{ route('admin.data_solo.index', 'bodyStyles') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.body_styles') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.data_solo.intColors">
                        <a href="{{ route('admin.data_solo.index', 'intColors') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.int_colors') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.data_solo.extColors">
                        <a href="{{ route('admin.data_solo.index', 'extColors') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.ext_colors') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.data_solo.transmissions">
                        <a href="{{ route('admin.data_solo.index', 'transmissions') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.transmissions') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.data_solo.driveTypes">
                        <a href="{{ route('admin.data_solo.index', 'driveTypes') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.drive_types') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.data_solo.fuelTypes">
                        <a href="{{ route('admin.data_solo.index', 'fuelTypes') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.fuel_types') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.data_solo.states" style="display:none;">
                        <a href="{{ route('admin.data_solo.index', 'states') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.STATES') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
        @endif



        @if (Auth::user()->IsSuper())
            <li class="" data-li-top="pricing-options" style="display:none;">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-usd"></i>
                    <span class="menu-text"> {{ trans('back.pricing_options') }} </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">

                    <li class="" data-li-identifier="admin.membership-plans.index" style="display:none;">
                        <a href="{{ route('admin.membership-plans.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.membership_plans') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.listing-plans.index">
                        <a href="{{ route('admin.listing-plans.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.listing_plans') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.highfeat-plans.index">
                        <a href="{{ route('admin.highfeat-plans.index') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.highlight_feature_plans') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                </ul>

            </li>
        @endif



        @if (Auth::user()->hasPermissionsInGroup('payments'))
            <li class="" data-li-identifier="admin.payments.index" style="display:none;">
                <a href="{{ route('admin.payments.index') }}">
                    <i class="menu-icon fa fa-money"></i>
                    <span class="menu-text"> {{ trans('back.payments') }} </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif



        @if (Auth::user()->IsSuper())
            <li class="" data-li-identifier="admin.permissions" style="display:none;">
                <a href="{{ route('admin.permission-groups.index') }}">
                    <i class="menu-icon fa fa-unlock-alt"></i>
                    <span class="menu-text"> {{ trans('back.permissions') }} </span>
                </a>
                <b class="arrow"></b>
            </li>
        @endif
@if(Auth::user()->IsSuper())
            <li class="" data-li-top="site-configuration">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-cogs"></i>
                    <span class="menu-text"> {{ trans('back.site_configuration') }}</span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="" data-li-identifier="admin.settings.site-pref">
                        <a href="{{ route('admin.settings.site-pref') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.website_settings') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.settings.front-int">
                        <a href="{{ route('admin.settings.front-int') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.front_interface') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.settings.admin-int">
                        <a href="{{ route('admin.settings.admin-int') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.admin_interface') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.settings.local">
                        <a href="{{ route('admin.settings.local') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.localization_settings') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.settings.mail">
                        <a href="{{ route('admin.settings.mail') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.mail_settings') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.settings.payment" style="display:none;">
                        <a href="{{ route('admin.settings.payment') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.payment_settings') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.settings.image">
                        <a href="{{ route('admin.settings.image') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.image_settings') }}
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="" data-li-identifier="admin.settings.email-not" style="display:none;">
                        <a href="{{ route('admin.settings.email-not') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            {{ trans('back.email_notifications') }}
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
        @endif


        <li class="">
            <a href="{{ route('admin.sessions.destroy') }}">
                <i class="menu-icon fa fa-power-off"></i>
                <span class="menu-text"> {{ trans('back.log_out') }} </span>
            </a>
            <b class="arrow"></b>
        </li>


    </ul>
    <!-- /.nav-list -->

    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>

<!-- /section:basics/sidebar -->