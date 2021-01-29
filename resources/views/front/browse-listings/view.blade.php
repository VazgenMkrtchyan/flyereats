@extends('front.layout.master')

@section('meta-description', $listing->present()->metaDescription)
@section('meta-title', siteTitle($listing->present()->listingName))

@section('og-data')
        <!-- Open Graph data (for Facebook and Google+) -->
<meta property="og:title" content="{{ $listing->present()->listingName }}">
<meta property="og:site_name" content="{{ appCon()->web_name }}">
<meta property="og:url" content="{{ URL::current() }}">
<meta property="og:description" content="{{ $listing->present()->listingName }} - ONLY {{ $listing->present()->listingPrice }}">
<meta property="og:image" content="{{ $listing->present()->mainPhotoUrl }}">
@stop

@section('content')

    <div class="listing-view-page">

        <div class="row">

            <div class="col-xs-12">
                <div class="listing-nav clearfix">
                    <div class="left">
                        <i class="fa fa-reply"></i> <a href="{{ route('browselistings.index', Session::get('search_url')) }}">{{ trans('front.back_to_results') }}</a>
                    </div>
                    <div class="right">
                        <span class="visible-xs"><i class="fa fa-envelope-o"></i> <a href="#listing-enquiry">{{ trans('front.enquiry') }}</a></span><i class="fa fa-print"></i> <a href="" data-printable-page>{{ trans('front.printable_page') }}</a>
                    </div>
                </div>

                <div class="listing-header clearfix">
                    <h1 class="listing-title">{{ $listing->present()->listingName }}</h1>
                    <span class="listing-price">{{ $listing->present()->listingPrice }}</span>
                    <span class="listing-love-view" data-love-listing="{{ route('love_listing', $listing->id) }}">
                        @if ($listing->isLoved())
                            <i class="fa fa-heart" title="Undo"></i>
                        @else
                            <i class="fa fa-heart-o" title="Love Listing"></i>
                        @endif
                    </span>
                </div>
            </div>


            <div class="col-xs-12">
                <div class="row">

                    <div class="col-sm-8">
                        <!-- PHOTOS -->
                        <div class="listing-photos">
                            @if (count($listing->photos))
                                <i class="fa fa-spinner fa-pulse loading"></i>
                                <ul id="view-image-gal">
                                    @foreach($listing->photos->take( $listing->maxPhotosNo() == 'UNLIMITED' ? 1000 : $listing->maxPhotosNo() ) as $photo)
                                        <li data-thumb="{{ asset('templates/misc/photo_empty.png') }}" data-thumb-src="{{ $photo->present()->thumbUrl() }}">

                                            <img data-src="{{ $photo->present()->photoUrl()}}" src="{{ asset('templates/misc/photo_empty.png') }}">

                                        </li>
                                    @endforeach
                                </ul>

                            @else
                                <img src="{{ asset('templates/misc/no_listing_photo_enlarge.png') }}" class="img-thumbnail">

                            @endif
                        </div>


                        <div class="listing-details">

                            <div class="main-listing-details margin-b-30">
                                <h3><i class="fa fa-cogs"></i> {{ trans('front.main_vehicle_details') }}</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="listing-details-table">
                                            <tbody>
                                            <tr>
                                                <td>{{ trans('front.make') }}:</td>
                                                <td class="info">{{ $listing->present()->carMake }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('front.car_model') }}:</td>
                                                <td class="info">{{ $listing->present()->carModel }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('front.year_manufactured') }}:</td>
                                                <td class="info">{{ $listing->year }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('front.mileage') }}:</td>
                                                <td class="info">{{ $listing->present()->carMileage }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('front.condition') }}:</td>
                                                <td class="info">{{ $listing->present()->carCondition }}</td>
                                            </tr>
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="listing-details-table">
                                            <tbody>
                                                 <tr>
                                                <td>{{ trans('front.body_style') }}:</td>
                                                <td class="info">{{ $listing->present()->carBodyStyle }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('front.transmission') }}:</td>
                                                <td class="info">{{ $listing->present()->carTransmission }}</td>
                                            </tr>
                                            <tr style="display:none;">
                                                <td>{{ trans('front.drive_type') }}:</td>
                                                <td class="info">{{ $listing->present()->carDriveType }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('front.fuel_type') }}:</td>
                                                <td class="info">{{ $listing->present()->carFuelType }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('front.ext_color') }}:</td>
                                                <td class="info">{{ $listing->present()->carExtColor }}</td>
                                            </tr>
                                            <tr style="display:none;">
                                                <td>{{ trans('front.int_color') }}:</td>
                                                <td class="info">{{ $listing->present()->carIntColor }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ trans('front.doors') }}:</td>
                                                <td class="info">{{ $listing->doors }}</td>
                                            </tr>
                                            <tr style="display:none;">
                                                <td>{{ trans('front.passengers') }}:</td>
                                                <td class="info">{{ $listing->passengers }}</td>
                                            </tr>
                                            <tr style="display:none;">
                                                <td>{{ trans('front.engine_cylinders') }}:</td>
                                                <td class="info">{{ $listing->engine_cyl ? $listing->engine_cyl : 'N/A' }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            @if ($listing->description)
                                <div class="seller-comments margin-b-30">
                                    <h3><i class="fa fa-comment-o"></i> {{ trans('front.sellers_comments') }}</h3>
                                    <div>{{ $listing->description }}</div>
                                </div>
                            @endif


                            <div class="vehicle-features margin-b-30">
                                <h3><i class="fa fa-check-square-o"></i> {{ trans('front.vehicle_features') }}</h3>
                                <div class="row">
                                    @foreach ($listing->features as $feature)
                                        <div class="col-sm-4 col-lg-3 col-xs-6 listing-features">
                                            <i class="fa fa-check"></i> {{ $feature->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="listing-location margin-b-30">
                                <h3><i class="fa fa-map-marker"></i> {{ trans('front.vehicle_location') }}</h3>
                                <div id="map_canvas" style="width:100%; height:450px;"></div>
                            </div>

                        </div> <!-- ./listing details -->
                    </div>

                    <div class="col-sm-4">
<!-- Seller Details -->
                        @include('front.browse-listings.partials.company-info')

                        @if ($seller->displayCompany())
                            @include('front.browse-listings.partials.seller-info')
                        @endif

                        <!-- Listing Enquiry -->
                        <div class="side-widget" id="listing-enquiry">
                            <div class="header"><i class="fa fa-envelope-o" style="color:red;"></i> {{ trans('front.enquire_listing') }}</div>
                            <div class="content">

                                <!--enquiry sent notify-->
                                <div class="alert alert-success" role="alert" id="enquiry-sent" style="display: none">
                                    {{ trans('front.listing_enquiry_sent') }}
                                </div>

                                <!-- Form -->
                                {{ Form::open(['route' => ['enquiry.send', $listing->id], 'id' => 'form-enquiry']) }}

                                <div class="form-group">
                                    {{ Form::label('name', trans('front.name').': *') }}
                                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('email', trans('front.email').': *') }}
                                    {{ Form::email('email', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('message', trans('front.message').': *') }}
                                    {{ Form::textarea('message', $listing->present()->defaultEnquiryText, ['class' => 'form-control', 'rows' => 5]) }}
                                </div>

                                @if (appCon()->captcha_contact_forms)
                                    <div class="form-group" id="recaptcha_view_listing">
                                        {{ Recaptcha::render(['callback' => 'recaptchaCallback']) }}
                                        <input type="hidden" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                    </div>
                                @endif

                                
                                {{ Form::close() }}
                                        <!-- End of form -->
                            </div>
                        </div>

                        

                        <div class="side-widget social-share-links">
                            <div class="header"><i class="fa fa-share-alt" style="color:red;"></i> {{ trans('front.social_share_links') }}</div>
                            <div class="content">
                                <div class="share-link">
                                    <a target="_blank" onclick="return !window.open(this.href, 'Facebook', 'width=640,height=300')" href="http://www.facebook.com/sharer/sharer.php?u={{ URL::current() }}"><i class="fa fa-fw fa-facebook-square"></i> {{ trans('front.share_on_fb') }}</a>
                                </div>
                                <div class="share-link">
                                    <a href="https://twitter.com/intent/tweet?text={{ $listing->present()->listingName }}+-+ONLY+{{ $listing->present()->listingPrice }}+on+{{ URL::current() }}" target="_blank" onclick="return !window.open(this.href, 'Facebook', 'width=540,height=500')"><i class="fa fa-fw fa-twitter"></i> {{ trans('front.share_on_tw') }}</a>
                                </div>
                                <div class="share-link">
                                    <a href="https://plus.google.com/share?url={{ URL::current() }}" onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-fw fa-google-plus"></i> {{ trans('front.share_on_g+') }}</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

@stop

@section('additional-scripts')
    @include('front.browse-listings.js.js-view')
@stop