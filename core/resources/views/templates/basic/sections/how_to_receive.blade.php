@php
$transferWay = getContent('how_to_receive.content', true);
$transferElement = getContent('how_to_receive.element', false, null, true);
@endphp


<style>

</style>
		<section class="events section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-12">
						<div class="section-title bg">
							<h2> @lang('How to receive money')<span></span></h2>
							<p>.</p>
							<div class="icon"><i class="fa fa-paper-plane"></i></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5 col-12">
						<div class="event-img">
            <img src="{{ getImage('assets/images/img/HandCongolesefranc.png') }}" class="img-fluid" alt="">
						</div>
					</div>
					<div class="col-lg-7 col-12">
						<div class="coming-event">
							<!-- Single Event -->
							<div class="single-event">
								<div class="event-date">
									<p>#<span></span></p>
								</div>
								<div class="event-content">
									<h3 class="event-title"><a href=""> @lang('Bank account')</a></h3>
									<p>@lang('Recipients can receive funds directly into their bank accounts.')</p>
									<span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i>  </span>
								</div>
							</div>
							<!-- End Single Event -->
							<!-- Single Event -->
							<div class="single-event">
								<div class="event-date">
									<p>#<span></span></p>
								</div>
								<div class="event-content">
									<h3 class="event-title"><a href="event-single.html">@lang('Mobile wallet')</a></h3>
									<p>@lang(' Mobile wallet is a fast and convenient way to send money directly to recipients phones.')</p>
									<span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<!-- End Single Event -->
							<!-- Single Event -->
							<div class="single-event">
								<div class="event-date">
									<p> #<span></span></p>
								</div>
								<div class="event-content">
									<h3 class="event-title"><a href="event-single.html">@lang('Canal alternatif')</a></h3>
									<p>@lang('Beneficiaries can receive the tokens that will allow them to withdraw the funds without a card at ATMs.')</p>
									<span class="entry-date-time"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
								</div>
							</div>
							<!-- End Single Event -->
						</div>
					</div>
				</div>
			</div>
		</section>
		

<!--<section class="service section bg-gray">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>Comment recevoir de l'argent</h2>
					<p><a href="https://themefisher.com/products/small-apps-free-app-landing-page-template/"></a>
					</p>
				</div>
			</div>
		</div>
		<div class="row no-gutters">
			<div class="col-lg-6 align-self-center">
				<div class="service-thumb left" data-aos="fade-right">
					<img class="img-fluid" src="images/feature/iphone-ipad.jpg" alt="iphone-ipad">
				</div>
			</div>
			<div class="col-lg-5 mr-auto align-self-center">
				<div class="service-box">
					<div class="row align-items-center">
						<div class="col-md-6 col-xs-12">
							<div class="service-item">
								<i class="ti-bookmark"></i>
								<h3>Compte banquaire</h3>
								<p>Les bénéficiaires peuvent recevoir les fonds directement sur leurs comptes bancaires.</p>
							</div>
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="service-item">
								<i class="ti-pulse"></i>
								<h3>Portefeuil mobile</h3>
								<p>Le portefeuille mobile est un moyen rapide et pratique d’envoyer de l’argent directement sur le téléphone des bénéficiaires.</p>
							</div>
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="service-item">
								<i class="ti-bar-chart"></i>
								<h3>Canal alternatif</h3>
								<p>Les bénéfciaires peuvent revecoir les tokens qui vont leur permettre de retirer les fonds sans carte au niveau des distributeurs automatique des billets</p>
							</div>
						</div>
			
			
					</div>
				</div>
			</div>
		</div>
	</div>
</section>




<!-- Transfer Section  -->
<!--<div class="section">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-6">
                    <div class="text-md-center">
                        <h3 class="text-md-center mt-0 mb-4">
                            {{ __($transferWay->data_values->heading) }}
                        </h3>
                        <p class="text-md-center section__para mx-md-auto mb-0">
                            {{ __($transferWay->data_values->description) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach ($transferElement as $element)
                <div class="col-md-4">
                    <div class="features-card flex-column align-items-center bg--light-2">
                        <div class="icon icon--circle icon--xl bg--base text--white flex-shrink-0">
                            @php
                                echo $element->data_values->icon;
                            @endphp
                        </div>
                        <div class="features-card__content">
                            <h5 class="mt-0 mb-2 text-center">
                                {{ __($element->data_values->title) }}
                            </h5>
                            <p class="m-0 text-center">
                                {{ __($element->data_values->description) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>-->
<!-- Transfer Section End -->
