@php
$appContent = getContent('app.content', true);
$appElement = getContent('app.element', false, null, true);
@endphp
<!-- App Section  -->


<style>
    
    
    .events{
	background:#F8F8F8;
}
.event-img, .coming-event {
	margin-top: 30px;
}
.coming-event {
	padding-left: 35px;
}
.events .single-event {
	background: #fff;
	position: relative;
	margin-left: 0;
	padding: 30px 20px 30px 60px;
	margin-bottom: 30px;
	-webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
	-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
	-webkit-transition: all 0.3s ease 0s;
	-moz-transition: all 0.3s ease 0s;
	transition: all 0.3s ease 0s;
}
.events .single-event:last-child{
	margin:0;
}
.events .event-date {
	position: absolute;
	left: -35px;
	width: 70px;
	text-align: center;
	top: 50%;
	margin-top: -35px;
	padding: 10px 0;
	-webkit-transition: all 0.3s ease 0s;
	-moz-transition: all 0.3s ease 0s;
	transition: all 0.3s ease 0s;
}
.events .single-event:hover .event-date {
	border-radius:100%;
}
.events .event-date p {
	color: #fff;
	font-size: 30px;
	font-weight: 700;
	-webkit-transition: all 0.3s ease 0s;
	-moz-transition: all 0.3s ease 0s;
	transition: all 0.3s ease 0s;
}
.events .single-event:hover .event-date p{
	font-size:25px;
}
.events .event-date p span {
	display: block;
	font-size: 14px;
	font-weight:500;
}
.events .event-title {
	font-size: 18px;
	margin-bottom: 10px;
}
.events .event-title a {
	font-weight: 700;
	color: #252525;
	text-decoration:none;
    
    
}
.events .entry-date-time {
	color: #555;
	margin-top: 5px;
	display: block;
}
/* Events Archive */
.events.archive{}
.events.archive .single-event {
	padding: 15px;
	margin-top: 30px;
	margin-bottom: 0px;
}
.events.archive .event-image{
	position: relative;
	overflow:hidden;
}
.events.archive .event-image img{
	width: 100%;
	height: 100%;
}
.events.archive .single-event:hover .event-image img{
	-webkit-transform:scale(1.2);
	-moz-transform:scale(1.2);
	transform:scale(1.2);
}
.events.archive .event-date {
	top: 5px;
	margin: 0;
	left: 5px;
}
.events.archive .event-content{
	margin-top: 20px;
}

.topbar .single-widget::before,.topbar .single-widget p i,.topbar .social li:hover a,.topbar .login-register li a i,.header .logo a,.header .nav li:hover a,
.header .nav li.active a,.header .nav li .dropdown li:hover a,.header .nav li .dropdown li .dropdown.submenu li:hover a,.home-slider .owl-carousel .owl-nav div:hover,.course-search .form-group i,.courses .course-body .c-title:hover a,.courses .rattings li,.courses .course-info span:hover,.features .single-feature:hover .f-title,.register-today .cdown span,.register-today .form-group i,.register-today .nice-select i,.register-today .nice-select:hover,.fun-facts .icon,.teachers .social li a:hover,.teachers .teacher-content h4 span,.events .single-event:hover .event-title a,.events .entry-date-time i,.single-events .owl-carousel .owl-nav div:hover,.cta .text-content h2 span,.latest-news .news-title a:hover,.latest-news .news-title a:hover,.latest-news .news-meta span a:hover,.latest-news .news-meta span a i,.courses.single .owl-carousel .owl-nav div:hover,.courses.single .c-title a:hover,.courses.single .single-info i,.courses.single .teacher-content h4 span,.course-sidebar .course-price p,.course-sidebar .single-feature .value,.news-single .news-title a:hover,.news-single .meta span i,.news-single .form-group i,.main-sidebar .single-sidebar ul li a:hover,.main-sidebar .single-sidebar.s-course h4 a:hover,.main-sidebar .single-sidebar.s-course .meta span i,.main-sidebar .news-info a:hover,.main-sidebar .news-info span i,.main-sidebar .subscribe button:hover,.about-us .about-title span,.skill-main .circle strong span,.error-page .error-inner h2 span,.error-page  .social li a:hover,.contact .form-head .form-group i,.contact .contact-info:hover .icon i,.breadcrumbs ul li a:hover,.pricing .single-table:hover .bg-icon i,.footer .list li a:hover,.footer .copyright a{
	color: #05C46B;
}
.header .nav li a::before,.header .nav li a::after,.header .search-form button,.home-slider .slider-title,.home-slider .owl-carousel .owl-nav div,.course-search .list li:hover,.courses .teacher-info .title,.courses .price,.courses .owl-controls .owl-nav div:hover,.features .icon-img:before,.image-gallery #gallery-menu li.active,.image-gallery #gallery-menu li:hover,.image-gallery .gallery-nav li.active .cbp-filter-counter,.image-gallery .gallery-nav li:hover .cbp-filter-counter,.register-today .list li:hover,.fun-facts .single-fact:hover .icon,.teachers .social,.teachers .teacher-content:hover,.teachers .owl-controls .owl-nav div:hover,.testimonials .owl-controls .owl-dot.active span,.testimonials .owl-controls .owl-dot:hover span,.testimonials .video-box.overlay::before,.events .event-date,.single-events .social li:hover a,.single-events .project-info .single-info b,.latest-news .owl-controls .owl-nav div:hover,.courses.single .nav-tabs li a.active,.courses.single .nav-tabs li a:hover,.courses.single .course-required li:hover span,.courses.single .social li a:hover,.course-sidebar .course-feature h4::before,.news-single blockquote::before,.news-single .prev-next li a:hover,.news-single .single-comments a,.news-single .form-group .button,.main-sidebar .widget-title:before,.main-sidebar .widget-title i,.main-sidebar .subscribe:before,.main-sidebar .tags ul li a:hover,.about-us .btn.video-popup:hover,.faqs .panel.active .faq-title a,.contact .contact-info .icon i,.clients,.clients::before,#scrollUp,#scrollUp:hover,.breadcrumbs ul li.active a,.pricing .bg-icon i,.footer .social li:hover a,.footer .social li.active a,.footer .opening-times .list li .value.off,.footer .newsletter .button{
	background: #05C46B;
}
.header .nav li .dropdown,.header .nav li .dropdown.submenu,.course-search .form-group .list,.register-today .form-group .list{
	border-top-color:#05C46B;
}
.course-search .nice-select:hover:after,.courses .single-course .teacher-info:hover img,.testimonials .single-testimonial:hover img,.testimonials .owl-controls .owl-dot span,.news-single .meta-left .author img,.news-single .prev-next li a,.pricing .single-table:hover .bg-icon i{
	border-color:#05C46B;
}
.courses .teacher-info .title::before{
	border-bottom-color:#05C46B
}

.register-today .form-group input:hover,
.register-today .nice-select:hover,
.register-today .form-group textarea:hover{
	border-bottom-color:#05C46B;
} 

.fun-facts .single-fact:hover .icon::after{
	border-left-color:#05C46B;
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



/*===============================
	End Events CSS 
	
	
	

    
</style>

<!-- Events -->
		<section class="events section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-12">
						<div class="section-title bg">
							<h2>Comment transférer de l'argent en 3 étapes  <span>faciles</span></h2>
							<p>Linc vous permet d'envoyer de l'argent à vos amis et à votre famille à faible coût des frais et de manière simple.</p>
							<div class="icon"><i class="fa fa-paper-plane"></i></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5 col-12">
						<div class="event-img">
            <img src="{{ getImage('assets/images/img/money-removebg-preview.png') }}" class="img-fluid" alt="">
						</div>
					</div>
					<div class="col-lg-7 col-12">
						<div class="coming-event">
							<!-- Single Event -->
							<div class="single-event">
								<div class="event-date">
									<p>1<span>Etape</span></p>
								</div>
								<div class="event-content">
									<h3 class="event-title"><a href="">Créer un compte</a></h3>
									<p>Cela ne prend que quelques minutes et tout ce dont vous avez besoin est une adresse e-mail et un numéro de télèphone.</p>
									<span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i>  </span>
								</div>
							</div>
							<!-- End Single Event -->
							<!-- Single Event -->
							<div class="single-event">
								<div class="event-date">
									<p>2<span>Etape</span></p>
								</div>
								<div class="event-content">
									<h3 class="event-title"><a href="event-single.html">Entrez les détails</a></h3>
									<p>Ajoutez le destinataire (vous aurez besoin de son adresse, compte bancaire/IBAN, Swift/BIC) et des informations de paiement.</p>
									<span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<!-- End Single Event -->
							<!-- Single Event -->
							<div class="single-event">
								<div class="event-date">
									<p>3<span>Etape</span></p>
								</div>
								<div class="event-content">
									<h3 class="event-title"><a href="event-single.html">Confirmez et envoyezr</a></h3>
									<p>Vérifiez que les devises et le montant sont corrects, obtenez la date de livraison prévue et envoyez votre transfert d'argent.</p>
									<span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<!-- End Single Event -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Events -->
		
		
						    
				    	<div class="col-lg-6 offset-lg-3 col-12">
						<div class="section-title bg">
							<h2>Comment envoyer de l'  <span>argent</span></h2>
							<p>Linc vous propose d'envoyer de l'argent à vos amis et à votre famille à bas prix et de manière simple.</p>
							<div class="icon"><i class="fa fa-paper-plane"></i></div>
						</div>
					</div>
					
		<div class="features overlay section" data-stellar-background-ratio="0.5">
			<div class="container">
				<div class="row">

					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Feature -->
						<div class="single-feature">
							<div class="icon-img">
								<img src="images/feature1.jpg" alt="#">
								<i class="fa fa-clone"></i>
							</div>
							<div class="feature-content">
								<h4 class="f-title">Envoyer une demande d'argent</h4>
								<p>Au début, vous devez soumettre les informations requises à partir de la page d'envoi d'argent pour émettre une demande d'envoi d'argent.</p>
							</div>
						</div>
						<!--/ End Single Feature -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Feature -->
						<div class="single-feature">
							<div class="icon-img">
								<img src="images/feature2.jpg" alt="#">
								<i class="fa fa-book"></i>
							</div>
							<div class="feature-content">
								<h4 class="f-title">Effectuer le paiement</h4>
								<p>Après avoir soumis la demande d'envoi d'argent, vous devez terminer le processus de paiement par un mode de paiement.</p>
							</div>
						</div>
						<!--/ End Single Feature -->
					</div>
			
			
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Feature -->
						<div class="single-feature">
							<div class="icon-img">
								<img src="images/feature3.jpg" alt="#">
								<i class="fa fa-users"></i>
							</div>
							<div class="feature-content">
								<h4 class="f-title">Le destinatuer réçoit une notification</h4>
								<p>Une fois le processus de paiement terminé, votre destinataire en sera informé.</p>
							</div>
						</div>
						<!--/ End Single Feature -->
					</div>
					
										<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Feature -->
						<div class="single-feature">
							<div class="icon-img">
								<img src="images/feature3.jpg" alt="#">
								<i class="fa fa-users"></i>
							</div>
							<div class="feature-content">
								<h4 class="f-title">Le destinatuer réçoit une notification</h4>
								<p>Une fois le processus de paiement terminé, votre destinataire en sera informé.</p>
							</div>
						</div>
						<!--/ End Single Feature -->
					</div>
					
				</div>
			</div>
		</div>
		
		
		

		
<div class="section--top">
    <div class="container">
        <div class="row gy-5 g-lg-4 align-items-center justify-content-center">
            <div class="col-lg-6 col-md-5 col-sm-10"> 
                <img src="{{ getImage('assets/images/img/linc.png') }}" alt="{{ __($general->site_name) }}" class="img-fluid">
            </div>
            <div class="col-lg-6 col-md-7">
                <div class="ms-xxl-5">
                 	<div class="section-title bg">
							<h2>Utiliser dans une application   <span>mobile</span></h2>
							<p>Téléchargez gratuitement notre application pour envoyer de l'argent en ligne en quelques minutes. Suivez vos paiements et consultez l'historique de vos transferts où que vous soyez.</p>
							<div class="icon"><i class="fa fa-paper-plane"></i></div>
						</div>
			

                    <div class="hero__btn-group flex-lg-wrap gap-sm-4 mt-4 flex-nowrap gap-3">
                        <a target="_blank" href="{{ $appContent->data_values->play_store_url }}" class="t-link d-inline-block">
                            <img src="{{ getImage('assets/images/frontend/app/' . @$appContent->data_values->play_store_icon, '200x60') }}" alt="remitance" class="img-fluid">
                        </a>

                        <a target="_blank" href="{{ $appContent->data_values->app_store_url }}" class="t-link d-inline-block">
                            <img src="{{ getImage('assets/images/frontend/app/' . @$appContent->data_values->app_store_icon, '200x60') }}" alt="remitance" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- App Section End -->
