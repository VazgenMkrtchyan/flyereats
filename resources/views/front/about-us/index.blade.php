@extends('front.layout.master')

@section('meta-title', siteTitle(trans('front.title_about_us')))

@section('content')
 <style>
     
     /*--------------------------------------------------------------
# Why Us
--------------------------------------------------------------*/
.why-us .content {
  padding: 60px 100px 0 100px;
}

.why-us .content h3 {
  font-weight: 400;
  font-size: 34px;
  color: #37517e;
}

.why-us .content h4 {
  font-size: 20px;
  font-weight: 700;
  margin-top: 5px;
}

.why-us .content p {
  font-size: 15px;
  color: #848484;
}

.why-us .img {
  background-size: contain;
    background-repeat: no-repeat;
    background-position: center center;
    height: 700px;
    width: 460px;
}

.why-us .accordion-list {
  padding: 0 100px 60px 100px;
}

.why-us .accordion-list ul {
  padding: 0;
  list-style: none;
}

.why-us .accordion-list li + li {
  margin-top: 15px;
}

.why-us .accordion-list li {
  padding: 20px;
  background: #fff;
  border-radius: 4px;
}

.why-us .accordion-list a {
  display: block;
  position: relative;
  font-family: "Poppins", sans-serif;
  font-size: 16px;
  line-height: 24px;
  font-weight: 500;
  padding-right: 30px;
  outline: none;
}

.why-us .accordion-list span {
  color: #47b2e4;
  font-weight: 600;
  font-size: 18px;
  padding-right: 10px;
}

.why-us .accordion-list i {
  font-size: 24px;
  position: absolute;
  right: 0;
  top: 0;
}

.why-us .accordion-list p {
  margin-bottom: 0;
  padding: 10px 0 0 0;
}

.why-us .accordion-list .icon-show {
  display: none;
}

.why-us .accordion-list a.collapsed {
  color: #343a40;
}

.why-us .accordion-list a.collapsed:hover {
  color: #47b2e4;
}

.why-us .accordion-list a.collapsed .icon-show {
  display: inline-block;
}

.why-us .accordion-list a.collapsed .icon-close {
  display: none;
}

@media (max-width: 1024px) {
  .why-us .content, .why-us .accordion-list {
    padding-left: 0;
    padding-right: 0;
  }
}

@media (max-width: 992px) {
  .why-us .img {
    min-height: 400px;
  }
  .why-us .content {
    padding-top: 30px;
  }
  .why-us .accordion-list {
    padding-bottom: 30px;
  }
}

@media (max-width: 575px) {
  .why-us .img {
    min-height: 200px;
  }
}
@media (max-width: 575px) {
  .row {
   margin-left: -15px !important;
    margin-right: -15px !important;
  }
}
.row {
    margin-left: -100px;
    margin-right: -100px;
}
     
 </style>
 <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3>About<strong> Brighton Cars</strong></h3>
              <p>
<strong>Brighton Cars</strong> performance car specialists begun with a passion for performance vehicles. With nearly 10 years experience in the motor trade, working directly with sports and performance vehicles, we can offer you a wealth of experience in a friendly & hassle free environment. </br></br>Our aim is to assist you in finding your perfect performance car with complete peace of mind. Its nice to be nice, we aim to assist you, your family & friends, in being honest & trustworthy throughout your Masters experience.              </p>
            </div>

            <div class="accordion-list">
              <ul>
                <li>
                  <a data-toggle="collapse" class="collapse" href="#accordion-list-1"><span>01</span> Reasons To Buy From Us <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse show" data-parent=".accordion-list">
                    <p>
We can advise you on the vehicle you have in mind, we can even find your dream car for you if we do not currently have it in stock. We’re always looking for stock, so we’d be happy to offer you a no-obligation offer to buy your vehicle from you.                    </p>
                  </div>
                </li>

                <li>
                  <a data-toggle="collapse" href="#accordion-list-2" class="collapsed"><span>02</span> Sell your car? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-2" class="collapse" data-parent=".accordion-list">
                    <p>
Take the stress out of selling your car. At Brighton Cars, we consistently pay above our competitors and would love to make an offer for your vehicle. Don't be ripped off by huge online car buying companies and part-exchange offers.                    </p>
                  </div>
                </li>

                <li>
                  <a data-toggle="collapse" href="#accordion-list-3" class="collapsed"><span>03</span> Brighton Cars Finance? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-3" class="collapse" data-parent=".accordion-list">
                    <p>
Financing a car can be a confusing prospect. As an FCA regulated dealership, you can rely on us to explain all of the jargon and run through all of the options so you feel confident in making the right choice.                    </p>
                  </div>
                </li>

              </ul>
            </div>

          </div>

          <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("https://masterscars.co.uk/wp-content/uploads/2020/10/masters-bg3.jpg");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
        </div>

      </div>
    </section><!-- End Why Us Section -->
    
@stop