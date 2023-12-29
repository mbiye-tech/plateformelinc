@php
$chooseUsContent = getContent('choose_us.content', true);
$chooseUsElement = getContent('choose_us.element', false, null, true);
@endphp


<style>
    .gradient-banner {
  padding: 100px 0 170px;
  position: relative;
  overflow: hidden;
}

.gradient-banner::before {
  position: absolute;
  content: '';
  bottom: 0;
  left: 50%;
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  width: 200%;
  height: 200%;
  border-radius: 50%;
  background-image: linear-gradient(45deg, #009EC5 0%, #2e7eed 20%, #02225B 50%);
}

    
    .shapes-container {
  position: absolute;
  overflow: hidden;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.shapes-container .shape {
  position: absolute;
}

.shapes-container .shape::before {
  content: '';
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(255, 255, 255, 0.1);
  -webkit-transform: rotate(-35deg);
          transform: rotate(-35deg);
  position: absolute;
  border-radius: 50px;
}

.shapes-container .shape:nth-child(1) {
  top: 2%;
  left: 11%;
  width: 400px;
  height: 70px;
}

.shapes-container .shape:nth-child(2) {
  top: 14%;
  left: 18%;
  width: 200px;
  height: 15px;
}

.shapes-container .shape:nth-child(3) {
  top: 80%;
  left: 4%;
  width: 300px;
  height: 60px;
}

.shapes-container .shape:nth-child(4) {
  top: 85%;
  left: 15%;
  width: 100px;
  height: 10px;
}

.shapes-container .shape:nth-child(5) {
  top: 5%;
  left: 50%;
  width: 300px;
  height: 25px;
}

.shapes-container .shape:nth-child(6) {
  top: 4%;
  left: 52%;
  width: 200px;
  height: 5px;
}

.shapes-container .shape:nth-child(7) {
  top: 80%;
  left: 70%;
  width: 200px;
  height: 5px;
}

.shapes-container .shape:nth-child(8) {
  top: 55%;
  left: 95%;
  width: 200px;
  height: 5px;
}

.shapes-container .shape:nth-child(9) {
  top: 50%;
  left: 90%;
  width: 300px;
  height: 50px;
}

.shapes-container .shape:nth-child(10) {
  top: 30%;
  left: 60%;
  width: 500px;
  height: 55px;
}

.shapes-container .shape:nth-child(11) {
  top: 60%;
  left: 60%;
  width: 200px;
  height: 5px;
}

.shapes-container .shape:nth-child(12) {
  top: 35%;
  left: 75%;
  width: 200px;
  height: 5px;
}

.shapes-container .shape:nth-child(13) {
  top: 90%;
  left: 40%;
  width: 300px;
  height: 45px;
}

.shapes-container .shape:nth-child(14) {
  top: 54%;
  left: 75%;
  width: 200px;
  height: 5px;
}

.shapes-container .shape:nth-child(15) {
  top: 50%;
  left: 90%;
  width: 200px;
  height: 5px;
}

.shapes-container .shape:nth-child(16) {
  top: 50%;
  left: 81%;
  width: 100px;
  height: 5px;
}


 .features {
	background-image: url('assets/images/img/hero-bg.png');
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
	padding: 60px 0 90px;
}
.features .single-feature {
	position: relative;
	text-align: center;
	margin-top: 30px;
}
.features .icon-img {
	width: 80px;
	height: 80px;
	line-height: 80px;
	border-radius: 100%;
	position: relative;
	text-align: center;
	left: 0;
	display: inline-block;
	overflow:hidden;
}
.features .icon-img:before {
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	border-radius: 100%;
	z-index: 3;
	opacity: 1;
	-webkit-transition: all 0.3s ease 0s;
	-moz-transition: all 0.3s ease 0s;
	transition: all 0.3s ease 0s;
}
.features .single-feature:hover .icon-img:before {
	opacity: 0.5;
}
.features .icon-img img {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	border-radius: 100%;
	opacity: 0;
	visibility: hidden;
}
.features .single-feature:hover .icon-img img{
	opacity:1;
	visibility:visible;
	transform:scale(1.2);
}
.features .icon-img i {
	text-align: center;
	font-size: 25px;
	color: #fff;
	z-index: 333;
	position: relative;
}
.features .feature-content .f-title {
	font-size: 18px;
	margin: 15px 0;
	color: #fff;
}
.features .feature-content p {
	line-height: 22px;
	color: #ccc;
}

    
    .section-title1 {
	text-align: center;
	margin-bottom: 20px;
}
.section-title1 .icon {
	position: relative;
	margin-top: 15px;
}
.section-title1.text-left{
	padding:0;
}
.section-title1 .icon i {
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
.section-title1 .icon::before {
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
.section-title1 h2 {
	font-size: 34px;
	text-transform: capitalize;
	position: relative;
	margin-bottom: 10px;
	color : white;
}
.section-title1 p {
	font-size: 14px;
	font-weight: 400;
	line-height: 22px;
	color : white;

}
.section-title1 h2 span {
	font-weight: 300;
}

    
    
</style>

<div class="features overlay section" data-stellar-background-ratio="0.5">
			<div class="container">
			    
			    	<div class="col-lg-6 offset-lg-3 col-12">
						<div class="section-title1 bg">
							<h2>Pourquoi les gens nous choisissent pour le transfert d'<span>argent</span></h2>
							<p>.</p>
							<div class="icon"><i class="fa fa-paper-plane"></i></div>
						</div>
					</div>
				<div class="row">

				
		
					
				</div>
			</div>
		</div>
		

<section class="section pt-0 position-relative pull-top">
	<div class="container">
		<div class="rounded shadow p-5 bg-white">
			<div class="row">
				<div class="col-lg-4 col-md-6 mt-5 mt-md-0 text-center">
					<i class="ti-paint-bucket text-primary h1"></i>
					<h3 class="mt-4 text-capitalize h5 ">Moins cher que votre banque</h3>
					<p class="regular text-muted">Nous offrons des meilleurs taux de change et des frais moins élevés que la plupart des banques et des services de transfert d'argent conventionnels.</p>
				</div>
				<div class="col-lg-4 col-md-6 mt-5 mt-md-0 text-center">
					<i class="ti-shine text-primary h1"></i>
					<h3 class="mt-4 text-capitalize h5 ">Toujours solidaire</h3>
					<p class="regular text-muted"></p>
				</div>
				<div class="col-lg-4 col-md-12 mt-5 mt-lg-0 text-center">
					<i class="ti-thought text-primary h1"></i>
					<h3 class="mt-4 text-capitalize h5 ">La confiance est importante</h3>
					<p class="regular text-muted">Notre technologie de pointe protège vos transactions.</p>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>




<!-- Why Choose Us  -->

<!--<div class="section--bottom">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6 order-lg-1 order-2">
                <div class="section__img section__img--left">
                    <img src="{{ getImage('assets/images/frontend/choose_us/' . @$chooseUsContent->data_values->image, '635x455') }}" alt="{{ __($general->site_name) }}" class="img-fluid" />
                </div>
            </div>
            <div class="col-lg-6 order-lg-2 order-1">
                <div class="ms-xxl-4">
                    <h3 class="mt-0">{{ __($chooseUsContent->data_values->heading) }}</h3>
                    <ul class="list list--column icon-list">
                        @foreach ($chooseUsElement as $item)
                            <li class="list__item icon-list__item">
                                <div class="icon-list__box">
                                    <div class="icon icon--circle icon--xl bg--base text--white flex-shrink-0">
                                        @php
                                            echo $item->data_values->icon;
                                        @endphp
                                    </div>
                                    <div class="icon-list__content">
                                        <h5 class="mt-0">
                                            {{ __($item->data_values->title) }}
                                        </h5>
                                        <p class="icon-list__para mb-0">
                                            {{ __($item->data_values->description) }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Why Choose Us End -->
