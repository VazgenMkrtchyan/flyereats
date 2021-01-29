

<?php $__env->startSection('meta-title', siteTitle(trans('front.title_faq'))); ?>

<?php $__env->startSection('content'); ?>

    <h1><i class="fa fa-question-circle"></i> FAQ - Frequently Asked Questions</h1>
    <p>So you have a few questions about this site. We thought so, so we compiled this very handy Frequently Asked Questions section. If you still have questions, please contact us.</p>

    <h2>General Questions</h2>

    <hr>

    <h3>How do I register on this site?</h3>
    <p>You can register here. You should also see to Register button in the top right corner of the site. If you can't find it there, there's on in the footer.</p>

    <h3>How much does it cost to register on this site?</h3>
    <p>It's free to register. To use the main search area of the site, you do not have to register, but, if you would like to add vehicles to your favourites or if you would like to place an advert, you will need to register. We will not share your details with anyone. Please read our if you're concerned about privacy.</p>

    <h3>How can I suggest a new feature for this site?</h3>
    <p>You can suggest a new feature, by filling out this form.</p>

    <h3>I found a glitch in your system, what do I do now?</h3>
    <p>If we missed this glitch, please use the form and select the "A Glitch in your system" subject line and tell us more about it. Please also try and reproduce the glitch, take a screenshot and keep it in your documents, we'll probably ask for it, if we can not recreate the issue on our side. We appreciate your feedback and will work through it timeously.</p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>