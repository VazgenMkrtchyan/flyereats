@extends('front.layout.master')

@section('meta-title', siteTitle(trans('Sell Your Car')))

@section('content')

    <h1>{{ trans('Sell your car') }}</h1>

    <p style="font-size:16px;">Looking to sell your car? Whether you want to use the money as a deposit on your next vehicle or you just want some extra cash, at Car World we offer a great, no obligation vehicle buying service.
If you would like to sell your car to us, then tell us as much about your vehicle as you can using the form below and a member of our team will get back to you as soon as possible.</p>
<img src="https://sellyourcarnow.files.wordpress.com/2016/11/sell-your-car-online.jpg?w=1200" style="margin-left:8%;">
<div class="col-md-6" style="margin-left:25%;">
  <!-- Form -->
    {{ Form::open(['route' => 'sel.car', 'class' => 'form-horizontal', 'id' => 'form-val']) }}

<h2>Your vehicle details</h2></br>
            <!-- text field for 'Name'-->
            <div class="form-group">
    <label for="exampleFormControlSelect1">Vehicle type</label>
    <select class="form-control" id="exampleFormControlSelect1" name="type">
      <option>Car</option>
      <option>Bike</option>
      <option>Van</option>
    </select>
  </div>
    <div class="form-group">
    <label for="exampleFormControlInput1">Make</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" name="make" placeholder="">
  </div>
   <div class="form-group">
    <label for="exampleFormControlInput1">Model</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" name="model" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Vehicle registration</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" name="registration" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Mileage</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" name="mile" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Service history</label>
    <select class="form-control" id="exampleFormControlSelect1" name="history">
      <option>Full service history</option>
      <option>Partial service history</option>
      <option>First service not due</option>
      <option>No service history</option>
    </select>
  </div>
 <h2>Contact details</h2></br>
<div class="form-group">
    <label for="exampleFormControlInput1">Full Name</label>
    <input type="from-control" class="form-control" name="name" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Phone Number</label>
    <input type="from-control" class="form-control" name="phone" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email</label>
    <input type="from-control" class="form-control" name="email" id="exampleFormControlInput1" placeholder="">
  </div>


    <div class="form-group margin-t-30">
        <!-- submit for button -->
            <button class="btn-main" type="submit">
                {{ trans('front.CONTACT_US') }}
            </button>
        
    </div>

    {{ Form::close() }}
            <!-- End of form -->
            </div>
@stop


@section('modals')
    @include('front.pricing-info.partials.pricing-info-modals')
@stop