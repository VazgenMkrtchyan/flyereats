

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_faq'))); ?>

<?php $__env->startSection('content'); ?>

    <h1><i class="fa fa-question-circle"></i> FAQ - Frequently Asked Questions</h1>
    <p> If you still have questions, please contact us.</p>

    <h2>Booking</h2>

    <hr>

    <h3>How Old Must I be Before I can Hire a Van?</h3>
    <p>18+ - Subject to Insurance.</p>

    <h3>What sort of Driving Licence do I need to be able to rent a van?</h3>
    <p>Full U.K Driving Licence.</p>

    <h3>What if I have points on my licence?</h3>
    <p>Subject to Insurance Approval.</p>

    <h3>Can I add additional drivers?</h3>
    <p>Yes additional drivers may be added subject to Insurance Approval.</p>
    
    <h2>Collection & Drop Off</h2>

    <hr>

    <h3>What paperwork and documents are needed when I collect a van?</h3>
    <p>Full Driving Licence and proof of address - issued within the last 3 months. </p>

    <h3>What if I am going to be late?</h3>
    <p>Please contact our Hire Desk to make alternative arrangements.</p>

    <h3>Can I return my Vehicle early?</h3>
    <p>Yes, of course. Please contact our Hire Desk to arrange your off-hire. 48 Hours notice is required to arrange suitable return transfer to your depo.</p>

    <h3>Can I add additional drivers?</h3>
    <p>Yes additional drivers may be added subject to Insurance Approval.</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>