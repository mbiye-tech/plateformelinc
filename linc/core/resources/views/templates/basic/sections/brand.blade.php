@php
$brands = getContent('brand.element', false, null, true);
@endphp



<style>
    
    #clients {
  padding: 60px 0;
  box-shadow: inset 0px 0px 12px 0px rgba(0, 0, 0, 0.1);
}

#clients .clients-wrap {
  border-top: 1px solid #d6eaff;
  border-left: 1px solid #d6eaff;
  margin-bottom: 30px;
}

#clients .client-logo {
  padding: 64px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-right: 1px solid #d6eaff;
  border-bottom: 1px solid #d6eaff;
  overflow: hidden;
  background: #fff;
  height: 160px;
}

#clients .client-logo:hover img {
  transform: scale(1.2);
}

#clients img {
  transition: all 0.4s ease-in-out;
}


.section-title {
	text-align: center;
	margin-bottom: 20px;
}
.section-title .icon {
	position: relative;
	margin-top: 15px;
}
.section-title.text-left{
	padding:0;
}
.section-title .icon i {
	width: 40px;
	height: 40px;
	line-height: 40px;
	display: inline-block;
	text-align: center;
	border-radius: 100%;
	background: #05C46B;
	color: #fff;
	top: 0;
	position: relative;
	z-index: 4;
}
.section-title .icon::before {
	content: "";
	position: absolute;
	top: 50%;
	width: 100px;
	height: 2px;
	background: #05C46B;
	left: 50%;
	margin-left: -50px;
	margin-top: -1px;
}
.section-title h2 {
	font-size: 34px;
	text-transform: capitalize;
	position: relative;
	margin-bottom: 10px;
}
.section-title p {
	font-size: 14px;
	color: #555;
	font-weight: 400;
	line-height: 22px;
}
.section-title h2 span {
	font-weight: 300;
}



</style>





					
 <section id="clients" class="section-bg">

      <div class="container" data-aos="fade-up">

	<div class="col-lg-6 offset-lg-3 col-12">
						<div class="section-title bg">
							<h2>@lang('Operator')<span></span></h2>
							<p>@lang('The Different Operators Available')</p>
							<div class="icon"><i class="fa fa-paper-plane"></i></div>
						</div>
					</div>

        <div class="row g-0 clients-wrap clearfix" data-aos="zoom-in" data-aos-delay="100">

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ getImage('assets/images/frontend/brand/afri.png') }}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ getImage('assets/images/frontend/brand/62d090ac3171e1657835692.png') }}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ getImage('assets/images/frontend/brand/62d091e8542d31657836008.png') }}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo"> 
              <img src="{{ getImage('assets/images/frontend/brand/62d09160a43761657835872.png') }}"  class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ getImage('assets/images/frontend/brand/621b702f10f031645965359.png') }}"  class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ getImage('assets/images/frontend/brand/621b70350b8891645965365.png') }}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo"> 
              <img src="{{ getImage('assets/images/frontend/brand/621b70418387f1645965377.png') }}"class="img-fluid" alt="">
            </div>
          </div>

      
     <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo"> 
              <img src="{{ getImage('assets/images/frontend/brand/Primary.png') }}"class="img-fluid" alt="">
            </div>
          </div>
          

        </div>

      </div>

    </section>





<!-- Client Slider  -->
 <!--<div class="section--sm section--bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="client-slider">
                    @foreach ($brands as $brand)
                        <div class="client-slider__item">
                            <div class="client-card">
                                <img src={{ getImage('assets/images/frontend/brand/' . @$brand->data_values->image, '130x50') }} alt="{{ __($general->site_name) }}" class="client-card__img">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- Client Slider End -->
