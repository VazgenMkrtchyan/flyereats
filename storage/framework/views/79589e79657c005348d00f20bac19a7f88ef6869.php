

<?php $__env->startSection('meta-title', siteTitle(trans('Sell Your Car'))); ?>

<?php $__env->startSection('content'); ?>

    <h1><?php echo trans('Part Exchange'); ?></h1>

    <p style="font-size:16px;">If you already have a vehicle you may consider opting for a part exchange. A part exchange allows you to put the value of your old vehicle towards the cost of your new one and if you’re thinking of purchasing your next vehicle on finance, a part exchange could cover your deposit and even reduce your monthly payments.
</p>
<img src="https://www.broomfieldscars.co.uk/wp-content/uploads/2013/10/partexchange2.jpg" style="margin-left: 13%;
    width: 900px;">
<div class="col-md-6" style="margin-left:25%;">
  <!-- Form -->
    <?php echo Form::open(['route' => 'contactus.send', 'class' => 'form-horizontal', 'id' => 'form-val']); ?>

    
<h2>Your vehicle details</h2></br>
            <!-- text field for 'Name'-->
            <div class="form-group">
    <label for="exampleFormControlSelect1">Vehicle type</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Car</option>
      <option>Bike</option>
      <option>Van</option>
    </select>
  </div>
    <div class="form-group">
    <label for="exampleFormControlInput1">Make</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
   <div class="form-group">
    <label for="exampleFormControlInput1">Model</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Vehicle registration</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Mileage</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Service history</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Full service history</option>
      <option>Partial service history</option>
      <option>First service not due</option>
      <option>No service history</option>
    </select>
  </div>
 <h2>Contact details</h2></br>
<div class="form-group">
    <label for="exampleFormControlInput1">Full Name</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Phone Number</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email</label>
    <input type="from-control" class="form-control" id="exampleFormControlInput1" placeholder="">
  </div>


    <div class="form-group margin-t-30">
        <!-- submit for button -->
            <button class="btn-main" type="submit">
                <?php echo trans('front.CONTACT_US'); ?>

            </button>
        
    </div>

    <?php echo Form::close(); ?>

            <!-- End of form -->
            </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>