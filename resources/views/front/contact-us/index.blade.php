@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_contact_us')))

@section('content')
<script src="https://carsaleweb.co.uk/brighton/assets/js/main.js"></script>
<script src="https://carsaleweb.co.uk/brighton/assets/vendor/jquery/jquery.min.js"></script>
  <script src="https://carsaleweb.co.uk/brighton/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://carsaleweb.co.uk/brighton/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="https://carsaleweb.co.uk/brighton/assets/vendor/php-email-form/validate.js"></script>
  <script src="https://carsaleweb.co.uk/brighton/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="https://carsaleweb.co.uk/brighton/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="https://carsaleweb.co.uk/brighton/assets/vendor/venobox/venobox.min.js"></script>
  <script src="https://carsaleweb.co.uk/brighton/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="https://carsaleweb.co.uk/brighton/assets/vendor/aos/aos.js"></script>
<style>
    /*--------------------------------------------------------------
# Contact
--------------------------------------------------------------*/
.contact .info {
  border-top: 3px solid #47b2e4;
  border-bottom: 3px solid #47b2e4;
  padding: 30px;
  background: #fff;
  width: 100%;
  box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.1);
}

.contact .info i {
  font-size: 20px;
  color: #47b2e4;
  float: left;
  width: 44px;
  height: 44px;
  background: #e7f5fb;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50px;
  transition: all 0.3s ease-in-out;
}

.contact .info h4 {
  padding: 0 0 0 60px;
  font-size: 22px;
  font-weight: 600;
  margin-bottom: 5px;
  color: #37517e;
}

.contact .info p {
  padding: 0 0 10px 60px;
  margin-bottom: 20px;
  font-size: 14px;
  color: #6182ba;
}

.contact .info .email p {
  padding-top: 5px;
}

.contact .info .social-links {
  padding-left: 60px;
}

.contact .info .social-links a {
  font-size: 18px;
  display: inline-block;
  background: #333;
  color: #fff;
  line-height: 1;
  padding: 8px 0;
  border-radius: 50%;
  text-align: center;
  width: 36px;
  height: 36px;
  transition: 0.3s;
  margin-right: 10px;
}

.contact .info .social-links a:hover {
  background: #47b2e4;
  color: #fff;
}

.contact .info .email:hover i, .contact .info .address:hover i, .contact .info .phone:hover i {
  background: #47b2e4;
  color: #fff;
}

.contact .php-email-form {
  width: 100%;
  border-top: 3px solid #47b2e4;
  border-bottom: 3px solid #47b2e4;
  padding: 30px;
  background: #fff;
  box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12);
}

.contact .php-email-form .form-group {
  padding-bottom: 8px;
}

.contact .php-email-form .validate {
  display: none;
  color: red;
  margin: 0 0 15px 0;
  font-weight: 400;
  font-size: 13px;
}

.contact .php-email-form .error-message {
  display: none;
  color: #fff;
  background: #ed3c0d;
  text-align: left;
  padding: 15px;
  font-weight: 600;
}

.contact .php-email-form .error-message br + br {
  margin-top: 25px;
}

.contact .php-email-form .sent-message {
  display: none;
  color: #fff;
  background: #18d26e;
  text-align: center;
  padding: 15px;
  font-weight: 600;
}

.contact .php-email-form .loading {
  display: none;
  background: #fff;
  text-align: center;
  padding: 15px;
}

.contact .php-email-form .loading:before {
  content: "";
  display: inline-block;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  margin: 0 10px -6px 0;
  border: 3px solid #18d26e;
  border-top-color: #eee;
  -webkit-animation: animate-loading 1s linear infinite;
  animation: animate-loading 1s linear infinite;
}

.contact .php-email-form .form-group {
  margin-bottom: 20px;
}

.contact .php-email-form label {
  padding-bottom: 8px;
}

.contact .php-email-form input, .contact .php-email-form textarea {
  border-radius: 0;
  box-shadow: none;
  font-size: 14px;
  border-radius: 4px;
}

.contact .php-email-form input:focus, .contact .php-email-form textarea:focus {
  border-color: #47b2e4;
}

.contact .php-email-form input {
  height: 44px;
}

.contact .php-email-form textarea {
  padding: 10px 12px;
}

.contact .php-email-form button[type="submit"] {
  background: #47b2e4;
  border: 0;
  padding: 12px 34px;
  color: #fff;
  transition: 0.4s;
  border-radius: 50px;
}

.contact .php-email-form button[type="submit"]:hover {
  background: #209dd8;
}

@-webkit-keyframes animate-loading {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes animate-loading {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

/*--------------------------------------------------------------
# Breadcrumbs
--------------------------------------------------------------*/
.breadcrumbs {
  padding: 15px 0;
  background: #f3f5fa;
  min-height: 40px;
  margin-top: 72px;
}

@media (max-width: 992px) {
  .breadcrumbs {
    margin-top: 68px;
  }
}

.breadcrumbs h2 {
  font-size: 28px;
  font-weight: 600;
  color: #37517e;
}

.breadcrumbs ol {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding: 0 0 10px 0;
  margin: 0;
  font-size: 14px;
}

.breadcrumbs ol li + li {
  padding-left: 10px;
}

.breadcrumbs ol li + li::before {
  display: inline-block;
  padding-right: 10px;
  color: #4668a2;
  content: "/";
}

    
</style>
<!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact Us</h2>
          <p>Fell free to get in touch</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="fa fa-globe" aria-hidden="true"></i>
                <h4>Location:</h4>
                <p>160 Kemp House, City Road,
London, England, EC1V 2NX</p>
              </div>

              <div class="email">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                <h4>Email:</h4>
                <p>info@cardealerswebsites.co.uk</p>
              </div>

              <div class="phone">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <h4>Call:</h4>
                <p>07952 980 603</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d79466.84282182751!2d-0.6451448751932902!3d51.50699934377085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487663427e9e92a9%3A0xb16ca352b90b0206!2sSlough%2C%20UK!5e0!3m2!1sen!2smk!4v1606573255885!5m2!1sen!2smk" width="100%" height="290" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="https://carsaleweb.co.uk/brighton/assets/forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

@stop

@section('additional-scripts')
    @include('front.contact-us.js.js-index')
@stop