<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ siteTitle(trans('front.title_print_page', ['listingName' => $listing->present()->listingName])) }}</title>

    <!-- core CSS -->
    <link rel="stylesheet" href="{{ asset('templates/front/css/' . appCon()->color_scheme . '-theme.css') }}">
    
    <!-- font -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans%3A400%2C600%2C300&#038;subset=latin%2Clatin-ext&#038;ver=4.2.2' type='text/css' media='all' />
</head>

<body>

<div class="printable-page">

    <div class="print-close clearfix no-print">
        <span class="close-page">{{ trans('front.close_window') }}</span>
        <span class="print-page"><i class="fa fa-print"></i> {{ trans('front.print_page') }}</span>
    </div>


    <div class="listing-info margin-b-30">

        <h3>{{ $listing->present()->listingName }} - {{ $listing->present()->listingPrice }}</h3>

        <div class="listing-photos margin-t-30 margin-b-30">
            <h3><i class="fa fa-picture-o"></i> {{ trans('front.few_photos') }}</h3>
            @if ($listing->photos()->count())
                <div class="row">
                    @foreach($photos as $photo)
                        <div class="col-xs-4"><img src="{{ asset($photo->present()->thumbUrl()) }}" alt="Some Alternative Text" class="img-responsive img-thumbnail"></div>
                    @endforeach
                </div>
            @else
                {{ trans('front.listing_has_no_photos') }}
            @endif
        </div>


        <div class="listing-details margin-b-30">
            <h3><i class="fa fa-cogs"></i> {{ trans('front.main_vehicle_details') }}</h3>
            <div class="row">
                <div class="col-xs-6">
                    <table class="details-table">
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
                        <tr>
                            <td>{{ trans('front.body_style') }}:</td>
                            <td class="info">{{ $listing->present()->carBodyStyle }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('front.transmission') }}:</td>
                            <td class="info">{{ $listing->present()->carTransmission }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-6">
                    <table class="details-table">
                        <tbody>
                        <tr>
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
                        <tr>
                            <td>{{ trans('front.int_color') }}:</td>
                            <td class="info">{{ $listing->present()->carIntColor }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('front.doors') }}:</td>
                            <td class="info">{{ $listing->doors }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('front.passengers') }}:</td>
                            <td class="info">{{ $listing->passengers }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('front.engine_cylinders') }}:</td>
                            <td class="info">{{ $listing->engine_cyl }}</td>
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


        <div class="margin-b-30">
            <h3><i class="fa fa-check-square-o"></i> {{ trans('front.vehicle_features') }}</h3>
            <div class="row">
                @foreach ($listing->features as $feature)
                    <div class="col-xs-4">
                        <i class="fa fa-check"></i> {{ $feature->name }}
                    </div>
                @endforeach
            </div>
        </div>


        <div class="margin-b-30">
            <h3><i class="fa fa-user"></i> {{ trans('front.seller_details') }}</h3>
            <div class="row">
                <div class="col-xs-6">
                    <table class="details-table">
                        <tbody>
                        <tr>
                            <td>{{ trans('front.name') }}:</td>
                            <td class="info">{{ $seller->first_name }} {{ $seller->last_name }}</td>
                        </tr>
                        @if ($seller->show_phone AND $seller->phone)
                            <tr>
                                <td>{{ trans('front.phone') }}:</td>
                                <td class="info">{{ $seller->phone }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>{{ trans('front.email') }}:</td>
                            <td class="info">{{ $seller->email }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        @if ($seller->displayCompany())
            <div class="margin-b-30">
                <h3><i class="fa fa-building"></i> {{ trans('front.company_details') }}</h3>
                <div class="row">
                    <div class="col-xs-6">
                        <table class="details-table">
                            <tbody>
                            <tr>
                                <td>{{ trans('front.name') }}:</td>
                                <td class="info">{{ $seller->compprofile->name }}</td>
                            </tr>
                            @if ($seller->compprofile->email)
                                <tr>
                                    <td>{{ trans('front.email') }}:</td>
                                    <td class="info">{{ $seller->compprofile->email }}</td>
                                </tr>
                            @endif
                            @if ($seller->compprofile->phone)
                                <tr>
                                    <td>{{ trans('front.phone') }}:</td>
                                    <td class="info">{{ $seller->compprofile->phone }}</td>
                                </tr>
                            @endif
                            @if ($seller->compprofile->fax)
                                <tr>
                                    <td>{{ trans('front.fax') }}:</td>
                                    <td class="info">{{ $seller->compprofile->fax }}</td>
                                </tr>
                            @endif
                            @if ($seller->compprofile->web_url)
                                <tr>
                                    <td>{{ trans('front.website') }}:</td>
                                    <td class="info">{{ $seller->compprofile->web_url }}</td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                    @if ($seller->compprofile->logo)
                        <div class="col-xs-6">
                            <table class="details-table">
                                <tbody>
                                <tr>
                                    <td>
                                        <img src="{{ $seller->compprofile->logoUrl() }}" class="img-responsive">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        @endif


    </div>

    <div class="print-close clearfix no-print">
        <span class="close-page">{{ trans('front.close_window') }}</span>
        <span class="print-page"><i class="fa fa-print"></i> {{ trans('front.print_page') }}</span>
    </div>

</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script>
    $( document ).ready(function() {

        $( ".close-page" ).click(function() {
            window.close();
        });

        $( ".print-page" ).click(function() {
            window.print();
        });
    })
</script>

</body>
</html>
