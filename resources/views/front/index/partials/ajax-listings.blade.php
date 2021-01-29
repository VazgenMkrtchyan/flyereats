@foreach($listings as $listing)
    @include('front.browse-listings.partials.listing', ['listgrid' => 'grid'])
@endforeach