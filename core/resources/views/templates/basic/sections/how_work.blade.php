@php
$howWorkContent = getContent('how_work.content', true);
$howWorkElement = getContent('how_work.element', false, null, true);
@endphp


	<style>
	    
	    
	</style>
	
	
	<div class="features overlay section" data-stellar-background-ratio="0.5">
			<div class="container">
			    
			    	<div class="col-lg-6 offset-lg-3 col-12">
						<div class="section-title1 bg">
							<h2><span>Envoyez De L'argent À Faible Coût </span></h2>
							<p>.</p>
							<div class="icon"><i class="fa fa-paper-plane"></i></div>
						</div>
					</div>
				<div class="row">

				
		
					
				</div>
			</div>
		</div>

<!--<div class="section bg--light-2">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="text-center">
                        <h3 class="mt-0 mb-4">
                            {{ __($howWorkContent->data_values->heading) }}
                        </h3>
                        <p class="section__para mx-md-auto mb-0">
                            {{ __($howWorkContent->data_values->description) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="work--step">
        <div class="container">
            <div class="row g-4 g-md-0">
                @foreach ($howWorkElement as $work)
                    <div class="col-md-4">
                        <div class="step-card flex-column align-items-center">
                            <div class="icon icon--circle icon--xl step-icon flex-shrink-0">
                                @php
                                    echo $work->data_values->icon;
                                @endphp
                            </div>
                            <div class="features-card__content">
                                <h5 class="mt-0 mb-2 text-center">
                                    {{ __($work->data_values->title) }}
                                </h5>
                                <p class="m-0 text-center">
                                    {{ __($work->data_values->description) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div> 
<!-- Work Step End -->
