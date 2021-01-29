<div class="side-widget company-profile">
    <div class="header"><i class="fa fa-building" style="color:red;"></i> {{ trans('front.company_details') }}</div>
    <div class="content">
        @if ($seller->compprofile->logo)
            <div class="comp-logo">
                <img src="{{ $seller->compprofile->logoUrl() }}" class="img-responsive">
            </div>
        @endif
        <div class="comp-name"> </div>
        @if ($seller->compprofile->phone)
            <div class="comp-info"><i class="fa fa-phone"></i>{{ $seller->compprofile->phone }}</div>
        @endif
        @if ($seller->compprofile->email)
            <div class="comp-info"><i class="fa fa-envelope-o"></i>{{ $seller->compprofile->email }}</div>
        @endif
        @if ($seller->compprofile->fax)
            <div class="comp-info"><i class="fa fa-fax"></i>{{ $seller->compprofile->fax }}</div>
        @endif
        @if ($seller->compprofile->web_url)
            <div class="comp-info"><i class="fa fa-desktop"></i><a href="{{ $seller->compprofile->web_url }}" target="_blank">{{ $seller->compprofile->web_url }}</a></div>
        @endif
        <div class="comp-info"><i class="fa fa-map-marker"></i>31 lower Orwell street
Ipswich IP41BU</div>
        @if ($seller->compprofile->description)
            <div class="comp-info"><i class="fa fa-info"></i>{{{ $seller->compprofile->present()->compDesc['text'] }}}{{ $seller->compprofile->present()->compDesc['read_more'] }}</div>
        @endif
    </div>
</div>