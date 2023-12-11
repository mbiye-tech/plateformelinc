@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
    $contact = getContent('contact.content', true);
    $socials = getContent('social_icon.element', false, null, true);
    @endphp

    <!-- Map Section  -->

<style>
       /*!
 * Bootstrap v4.3.1 (https://getbootstrap.com/)
 * Copyright 2011-2019 The Bootstrap Authors
 * Copyright 2011-2019 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
:root {
  --blue: #007bff;
  --indigo: #6610f2;
  --purple: #6f42c1;
  --pink: #e83e8c;
  --red: #dc3545;
  --orange: #fd7e14;
  --yellow: #ffc107;
  --green: #28a745;
  --teal: #20c997;
  --cyan: #17a2b8;
  --white: #fff;
  --gray: #6c757d;
  --gray-dark: #343a40;
  --primary: #007bff;
  --secondary: #6c757d;
  --success: #28a745;
  --info: #17a2b8;
  --warning: #ffc107;
  --danger: #dc3545;
  --light: #f8f9fa;
  --dark: #343a40;
  --breakpoint-xs: 0;
  --breakpoint-sm: 576px;
  --breakpoint-md: 768px;
  --breakpoint-lg: 992px;
  --breakpoint-xl: 1200px;
  --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }


h1, h2, h3, h4, h5, h6 {
  margin-top: 0;
  margin-bottom: 0.5rem; }

p {
  margin-top: 0;
  margin-bottom: 1rem; }

table {
  border-collapse: collapse; }


th {
  text-align: inherit; }

label {
  display: inline-block;
  margin-bottom: 0.5rem; }

button {
  border-radius: 0; }

button:focus {
  outline: 1px dotted;
  outline: 5px auto -webkit-focus-ring-color; }


textarea {
  overflow: auto;
  resize: vertical; }


h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
  margin-bottom: 0.5rem;
  font-weight: 500;
  line-height: 1.2; }

h1, .h1 {
  font-size: 2.5rem; }

h2, .h2 {
  font-size: 2rem; }

h3, .h3 {
  font-size: 1.75rem; }

h4, .h4 {
  font-size: 1.5rem; }

h5, .h5 {
  font-size: 1.25rem; }

h6, .h6 {
  font-size: 1rem; }


.container {
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto; }
  @media (min-width: 576px) {
    .container {
      max-width: 540px; } }
  @media (min-width: 768px) {
    .container {
      max-width: 720px; } }
  @media (min-width: 992px) {
    .container {
      max-width: 960px; } }
  @media (min-width: 1200px) {
    .container {
      max-width: 1140px; } }

.row {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px; }

.no-gutters {
  margin-right: 0;
  margin-left: 0; }
  .no-gutters > .col,
  .no-gutters > [class*="col-"] {
    padding-right: 0;
    padding-left: 0; }

body {
  font-family: "Poppins", Arial, sans-serif;
  font-size: 16px;
  line-height: 1.8;
  font-weight: normal;
  background: #fafafa;
  color: gray; }

a {
  -webkit-transition: .3s all ease;
  -o-transition: .3s all ease;
  transition: .3s all ease;
  color: #01d28e;
  text-decoration: none;
}
  a:hover, a:focus {
    text-decoration: none !important;
    outline: none !important;
    -webkit-box-shadow: none;
    box-shadow: none; }

h1, h2, h3, h4, h5,
.h1, .h2, .h3, .h4, .h5 {
  line-height: 1.5;
  font-weight: 400;
  font-family: "Poppins", Arial, sans-serif;
  color: #000; }


.ftco-section {
  padding: 7em 0; }

.ftco-no-pt {
  padding-top: 0; }

.ftco-no-pb {
  padding-bottom: 0; }

.heading-section {
  font-size: 28px;
  color: #000; }

textarea.form-control {
  height: inherit !important; }

.wrapper {
  width: 100%;
  -webkit-box-shadow: 0px 21px 41px -13px rgba(0, 0, 0, 0.18);
  -moz-box-shadow: 0px 21px 41px -13px rgba(0, 0, 0, 0.18);
  box-shadow: 0px 21px 41px -13px rgba(0, 0, 0, 0.18); }

.contact-wrap {
  background: #fff; }

.info-wrap {
  color: rgba(255, 255, 255, 0.8); }
  .info-wrap h3 {
    color: #fff; }
  .info-wrap .dbox {
    width: 100%;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 25px; }
    .info-wrap .dbox:last-child {
      margin-bottom: 0; }
    .info-wrap .dbox p {
      margin-bottom: 0; }
      .info-wrap .dbox p span {
        font-weight: 500;
        color: #fff; }
      .info-wrap .dbox p a {
        color: #fff; }
    .info-wrap .dbox .icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      border: 2px solid rgba(255, 255, 255, 0.2); }
      .info-wrap .dbox .icon span {
        font-size: 20px;
        color: #fff; }
    .info-wrap .dbox .text {
      width: calc(100% - 50px); }

.btn {
  padding: 12px 16px;
  cursor: pointer;
  border-width: 1px;
  border-radius: 5px;
  font-size: 14px;
  font-weight: 400;
  -webkit-box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.12);
  -moz-box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.12);
  box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.12);
  position: relative;
  margin-bottom: 20px;
  -webkit-transition: 0.3s;
  -o-transition: 0.3s;
  transition: 0.3s; }
  @media (prefers-reduced-motion: reduce) {
    .btn {
      -webkit-transition: none;
      -o-transition: none;
      transition: none; } }
  .btn:hover, .btn:active, .btn:focus {
    outline: none !important;
    -webkit-box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.22) !important;
    -moz-box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.22) !important;
    box-shadow: 0px 10px 20px -6px rgba(0, 0, 0, 0.22) !important; }
  .btn.btn-primary {
    background: #007bff !important;
    border-color: #007bff !important;
    color: #fff; }
    .btn.btn-primary:hover, .btn.btn-primary:focus {
      border-color: #019f6c !important;
      background: #019f6c !important; }

.contactForm .label {
  color: #000;
  text-transform: uppercase;
  font-size: 12px;
  font-weight: 600; }

.contactForm .form-control {
  border: none;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  padding: 0; }

#contactForm .error {
  color: red;
  font-size: 12px; }

#contactForm .form-control {
  font-size: 16px; }

#message {
  resize: vertical; }

#form-message-warning, #form-message-success {
  display: none; }

#form-message-warning {
  color: red; }

#form-message-success {
  color: #28a745;
  font-size: 18px;
  font-weight: bold; }

.submitting {
  float: left;
  width: 100%;
  padding: 10px 0;
  display: none;
  font-size: 16px;
  font-weight: bold; }
                         





 
.main-content {
    padding-top: 100px;
    padding-bottom: 100px;
}
 
.flex-center {
    align-items: center;
}
.accordion-button{
    margin-bottom: 10px;
}
.accordion-body {
    margin-top: 15px;
    padding: 25px;
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 25px -3px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
}
 
.circle-icon {
    height: 50px;
    width: 50px;
    border-radius: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #2b4eff;
    border: 5px solid #b2bfff;
    color: #fff;
    margin-left: -20px;
    margin-right: 10px;
    transform: scale(1.2);
}
.accordion-item{
    border: 0px!important;
}
.accordion-button:not(.collapsed){
    border: 0px!important;
    color: #0c63e4;
    background-color: #ffffff;
    box-shadow: inset 0 0px 0 rgb(0 0 0 / 13%);
}



</style>

    
    
    
    <div class="section">
        
        <div class="container">
            
            <div class="row g-4 justify-content-between">
                
                
                
                <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Laissez nous un message </h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="wrapper">
						<div class="row no-gutters">
							<div class="col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
								<div class="contact-wrap w-100 p-md-5 p-4">
									<h3 class="mb-4"></h3>
									<div id="form-message-warning" class="mb-4"></div> 
				      		<div id="form-message-success" class="mb-4">
				            Your message was sent, thank you!
				      		</div>
									<form method="POST" id="contactForm" name="contactForm" class="contactForm">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="label" for="name">Nom Complet</label>
													<input type="text" class="form-control" name="name" id="name" placeholder="Name">
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<label class="label" for="email">Email Address</label>
													<input type="email" class="form-control" name="email" id="email" placeholder="Email">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="subject">Subject</label>
													<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label class="label" for="#">Message</label>
													<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="submit" value="Send Message" class="btn btn-primary">
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-lg-4 col-md-5 d-flex align-items-stretch">
								<div class="info-wrap bg-primary w-100 p-md-5 p-4">
									<h3>Plus d'information</h3>
									<p class="mb-4">Si vous avez des questions sur l'envoi d'argent ou les taux de change, n'hésitez pas à nous les poser</p>
				        	<div class="dbox w-100 d-flex align-items-start">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-map-marker"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Address:</span> 46B ,Avenue du Livre, Commune de la Gombe, Kinshasa, République Démocratique du Congo</p>
					          </div>
				          </div>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-phone"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Phone:</span> <a href="tel://00243850000763">+243 850 000 763</a></p>
					          </div>
				          </div>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-paper-plane"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@linc.cd</a></p>
					          </div>
				          </div>
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-globe"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Website</span> <a href="#">pay.linc.cd</a></p>
					          </div>
				          </div>
			          </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
                <!--
                <div class="col-lg-6 col-xl-5">

                    <div class="bg--light">
                        <form action="" method="POST" class="verify-gcaptcha row g-3 g-sm-4 login__form">
                            @csrf
                            <div class="col-12">
                                <h4 class="mt-0">{{ __($contact->data_values->title) }}</h4>
                                <p class="mb-0">
                                    {{ __($contact->data_values->description) }}
                                </p>
                            </div>

                            @guest
                                <div class="col-12">
                                    <label class="d-block sm-text mb-2">@lang('Name')</label>
                                    <input name="name" type="text" class="form-control form--control" value="{{ old('name') }}" required>
                                </div>

                                <div class="col-12">
                                    <label class="d-block sm-text mb-2">@lang('Email')</label>
                                    <input name="email" type="email" class="form-control form--control" value="{{ old('email') }}" required>
                                </div>
                            @else
                                <div class="col-12">
                                    <label class="d-block sm-text mb-2">@lang('Name')</label>
                                    <input class="form-control form--control" value="{{ auth()->user()->fullname }}" disabled>
                                </div>

                                <div class="col-12">
                                    <label class="d-block sm-text mb-2">@lang('Email')</label>
                                    <input class="form-control form--control" value="{{ auth()->user()->email }}" disabled>
                                </div>
                            @endguest
                            <div class="col-12">
                                <label class="d-block sm-text mb-2">@lang('Subject')</label>
                                <input name="subject" type="text" class="form-control form--control" value="{{ old('subject') }}" required>
                            </div>

                            <div class="col-12">
                                <label class="d-block sm-text mb-2">@lang('Message')</label>
                                <textarea name="message" wrap="off" class="form-control form--control-textarea" required>{{ old('message') }}</textarea>
                            </div>

                            <x-captcha class="d-block sm-text"></x-captcha>
                            <div class="col-12">
                                <button class="btn btn--xl btn--base"> @lang('Send Message') </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                
                
                <div class="col-lg-6 col-xl-5">
                    <div class="d-flex flex-column gap-5">
                        <img src="{{ getImage('assets/images/frontend/contact/' . @$contact->data_values->image, '525x395') }}" alt="" class="img-fluid d-none d-lg-block">
                        <ul class="list list--column">
                            <li class="list--column__item">
                                <div class="header-top__info">
                                    <span class="header-top__icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <span class="header-top__text t-short-para"> {{ __($contact->data_values->address) }}</span>
                                </div>
                            </li>
                            <li class="list--column__item">
                                <div class="header-top__info">
                                    <span class="header-top__icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </span>
                                    <span class="header-top__text t-short-para"> {{ __($contact->data_values->mobile) }}</span>
                                </div>
                            </li>
                            <li class="list--column__item">
                                <div class="header-top__info">
                                    <span class="header-top__icon">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                    <span class="header-top__text t-short-para"> {{ __($contact->data_values->email) }}</span>
                                </div>
                            </li>
                            <li class="list--column__item">
                                <ul class="list list--row-sm align-items-center">
                                    @foreach ($socials as $social)
                                        <li>
                                            <a href="{{ $social->data_values->url }}" target="_blank" class="social-icon">
                                                @php
                                                    echo $social->data_values->icon;
                                                @endphp
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                -->
                
                
                <section class="main-content">
  <div class="container">
    <h1 class="text-center text-uppercase mb-5">Que Voulez-vous savoir?</h1>
    <br>
    <br>
    <div class="row flex-center">
      <div class="col-sm-10 offset-sm-2">
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <div class="circle-icon"> <i class="fa fa-question"></i> </div>
              <span>C'est quoi Linc</span> </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body"> <strong></strong> Linc est une plateforme numérique qui vous permet de d'effectuer vos transactions partout dans le monde à moindre cout, Linc est une plateforme numérique qui vous permet de d'effectuer vos transactions partout dans le monde à moindre cout,
                 </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <div class="circle-icon"> <i class="fa fa-question"></i> </div>
              <span>Comment Envoyez de l'argent</span> </button>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body"> <strong>This is the second item's accordion body.</strong> Linc est une plateforme numérique qui vous permet de d'effectuer vos transactions partout dans le monde à moindre cout, Linc est une plateforme numérique qui vous permet de d'effectuer vos transactions partout dans le monde à moindre cout, Linc est une plateforme numérique qui vous permet de d'effectuer vos transactions partout dans le monde à moindre cout, Linc est une plateforme numérique qui vous permet de d'effectuer vos transactions partout dans le monde à moindre cout, </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> 
                <div class="circle-icon"> <i class="fa fa-question"></i> </div>
              <span>Combien ça coute </span> </button>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body"> <strong></strong> Linc est une plateforme numérique qui vous permet de d'effectuer vos transactions partout dans le monde à moindre cout, Linc est une plateforme numérique qui vous permet de d'effectuer vos transactions partout dans le monde à moindre cout,
              Linc est une plateforme numérique qui vous permet de d'effectuer vos transactions partout dans le monde à moindre cout, Linc est une plateforme numérique qui vous permet de d'effectuer vos transactions partout dans le monde à moindre cout,</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

                
            </div>
            
        </div>
        
        
    </div>


  

    <!-- Map Section End -->
    <div class="map-section">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-12">
                    <iframe class="map" src="https://maps.google.com/maps?q={{ $contact->data_values->latitude }},{{ $contact->data_values->longitude }}&hl=es&z=14&amp;output=embed"></iframe>
                </div>
            </div>
        </div>
    </div>



@endsection
