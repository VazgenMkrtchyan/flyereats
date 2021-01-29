@extends('front.layout.master')

@section('meta-title', appCon()->web_name . ' | ' . appCon()->web_desc)


@section('content')

    <!-- <h1>{{ trans('front.quick_search') }}</h1> -->
<style>

.showcase .showcase-text {
  padding: 3rem;
}

.showcase .showcase-img {
  min-height: 49rem;
  background-size: cover;
}

@media (min-width: 768px) {
  .showcase .showcase-text {
    padding: 4rem;
  }
}

.features-icons {
  padding-top: 7rem;
  padding-bottom: 7rem;
}

.features-icons .features-icons-item {
  max-width: 30rem;
}

.features-icons .features-icons-item .features-icons-icon {
  height: 7rem;
}

.features-icons .features-icons-item .features-icons-icon i {
  color: #0d315f;
  font-size: 5rem;
}

.features-icons .features-icons-item:hover .features-icons-icon i {
  font-size: 6rem;
}

.testimonials {
  padding-top: 7rem;
  padding-bottom: 7rem;
}

.testimonials .testimonial-item {
  max-width: 18rem;
}

.testimonials .testimonial-item img {
  max-width: 12rem;
  box-shadow: 0px 5px 5px 0px #adb5bd;
}

.call-to-action {
  position: relative;
  background-color: #343a40;
  background: url("../img/bg-masthead.jpg") no-repeat center center;
  background-size: cover;
  padding-top: 7rem;
  padding-bottom: 7rem;
}

.call-to-action .overlay {
  position: absolute;
  background-color: #212529;
  height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  opacity: 0.3;
}
.features-icons {
  padding-top: 7rem;
  padding-bottom: 7rem;
  .features-icons-item {
    max-width: 30rem;
    .features-icons-icon {
      height: 7rem;
      i {
        font-size: 4.5rem;
      }
    }
    &:hover {
      .features-icons-icon {
        i {
          font-size: 5rem;
        }
      }
    }
  }
}

.showcase {
  .showcase-text {
    padding: 3rem;
  }
  .showcase-img {
    min-height: 30rem;
    background-size: cover;
  }
  @media (min-width: 768px) {
    .showcase-text {
      padding: 7rem;
    }
  }
}
.no-gutters {
    margin-right: 0;
    margin-left: 0;
}


@media (max-width: 768px) {
    .listing-results.home-listing .img-data
    {
        width: 100% !important;
        height: auto !important;
    }


    .listing-results.home-listing .listing-data
    {
        width: 100% !important;
        height: auto!important;
        margin: 0;
        margin-bottom: 20px;
    }

    .listing-results.home-listing  .listing
    {
        margin: 0 auto;
        display: flex;
        padding: 12px;
    }

    .listing-results.home-listing .lslide img
    {
        width: 100% !important;
        height: 100% !important;
    }
    .block-bottom-footer{
        position: relative;
        margin-top: 125px;
    }
}
.listing-data.grid,.listing-data .img-data {
    width: 255px ;
}

.listing-data .img-data img {
    width: 253px;
}

</style>

 
@if (count($enhanced))
        <div class="content-slider" id="enhanced-listings"><!-- ENHANCED listings slider -->
            <div class="header clearfix">
                <div class="title"> Special Offers</div>
                <div class="nav-thumbs">
                    <div class="nav-left"><i class="fa fa-angle-left"></i></div><!--
                -->
                    <div class="nav-right"><i class="fa fa-angle-right"></i></div>
                </div>
            </div>
            <div class="slides">
                <i class="fa fa-spinner fa-pulse buffering-slides"></i>
                <ul class="light-slider">
                    @foreach($enhanced as $listing)
                        <li>
                            @include('front.browse-listings.partials.listing', ['listgrid'  => 'grid'])
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
  
   @if (count($recent))
        <div class="index-listings" id="recently-added" ><!-- RECENTLY ADDED listings + LOAD MORE -->
            <div class="header clearfix">
                <div class="title">{{ trans('Latest Arrivals') }}</div>
            </div>
            <div class="listing-results clearfix home-listing">
                @foreach($recent as $listing)
                    @include('front.browse-listings.partials.listing', ['listgrid' => 'grid'])
                    
                @endforeach
              
            </div>
            <div class="load-more">
                <button class="btn-main btn-load" data-load-url="{{ route('api_load_more') }}" data-load-step=4
                        data-max-load-listings=8 data-total-listings={{ $totalListings }}>
                    {{ trans('front.load_more') }}
                    <i class="fa fa-arrow-down"></i>
                    <i class="fa fa-spinner fa-pulse"></i>
                </button>
                <a href="{{ route('browselistings.index') }}" class="view-listings">
                    <button class="btn-main btn-load">
                        {{ trans('front.go_to_listings_page') }}
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </a>
            </div>
        </div>
    @endif
</br></br>
<!-- Image Showcases -->
  <section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('https://www.motoringresearch.com/wp-content/uploads/2019/08/Online-reviews-vital-in-choosing-a-car-dealer.jpg');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <h2 style="font-size:25px;">About Brighton Cars</h2>
          <p class="lead mb-0">Brighton Cars performance car specialists begun with a passion for performance vehicles. With nearly 10 years experience in the motor trade, working directly with sports and performance vehicles, we can offer you a wealth of experience in a friendly & hassle free environment.
Our aim is to assist you in finding your perfect performance car with complete peace of mind. </br></br> Its nice to be nice, we aim to assist you, your family & friends, in being honest & trustworthy throughout your Masters experience.</p>
            <a href="#" class="btn-learn-more" style="font-size:18px;">Read More</a>

        </div>
      </div>
      <div class="row no-gutters">
        
      <div class="row no-gutters">
      
      </div>
    </div>
  </section>

    
 


@stop

@section('additional-scripts')
    @include('front.index.js.js-index')
@stop