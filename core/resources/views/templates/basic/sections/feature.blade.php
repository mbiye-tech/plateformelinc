@php
$content = getContent('feature.content', true);
$features = getContent('feature.element', false, null, true);
@endphp


<style>
    
    
#why-us {
  padding: 60px 0;
  background: #004a99;
}

#why-us .section-header h3,
#why-us .section-header p {
  color: #fff;
}

#why-us .card {
  background: #00458f;
  border-color: #00458f;
  border-radius: 10px;
  margin: 0 15px;
  padding: 15px 0;
  text-align: center;
  color: #fff;
  transition: 0.3s ease-in-out;
  height: 100%;
}

@media (max-width: 991px) {
  #why-us .card {
    margin: 0;
  }
}

#why-us .card:hover {
  background: #003b7a;
  border-color: #003b7a;
}

#why-us .card i {
  font-size: 48px;
  padding-top: 15px;
  color: #bfddfe;
}

#why-us .card h5 {
  font-size: 22px;
  font-weight: 600;
}

#why-us .card p {
  font-size: 15px;
  color: #d8eafe;
}

#why-us .card .readmore {
  color: #fff;
  font-weight: 600;
  display: inline-block;
  transition: 0.3s ease-in-out;
  border-bottom: #00458f solid 2px;
  text-decoration:none;
    
}

#why-us .card .readmore:hover {
  border-bottom: #fff solid 2px;
}

#why-us .counters {
  padding-top: 40px;
}

#why-us .counters span {
  font-family: "Montserrat", sans-serif;
  font-weight: bold;
  font-size: 48px;
  display: block;
  color: #fff;
}

#why-us .counters p {
  padding: 0;
  margin: 0 0 20px 0;
  font-family: "Montserrat", sans-serif;
  font-size: 14px;
  color: #cce5ff;
}

#why-us .card-body h5
{
    color: white;
}

.section-header h3 {
  font-size: 36px;
  color: #283d50;
  text-align: center;
  font-weight: 500;
  position: relative;
}

.section-header p {
  text-align: center;
  margin: auto;
  font-size: 15px;
  padding-bottom: 60px;
  color: #556877;
  width: 50%;
}

@media (max-width: 767px) {
  .section-header p {
    width: 100%;
  }
}
</style>


    <section id="why-us">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h3>Pourquoi nous choisir ?</h3>
          <p></p>
        </header>

        <div class="row row-eq-height justify-content-center">

          <div class="col-lg-4 mb-4">
            <div class="card" data-aos="zoom-in" data-aos-delay="100">
              <i class="bi bi-calendar4-week"></i>
              <div class="card-body">
                <h5 class="card-title">Tarif pas cher</h5>
                <p class="card-text">Nous vous offrons un coût moindre pour envoyer de l'argent à l'étranger</p>
                <a href="#" class="readmore"></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card" data-aos="zoom-in" data-aos-delay="200">
              <i class="bi bi-credit-card-fill"></i>
              <div class="card-body">
                <h5 class="card-title">Sûr et sécurisé</h5>
                <p class="card-text">L'envoi de fonds est sûr et sécurisé car les destinataires reçoivent de l'argent de nos agents.</p>
                <a href="#" class="readmore"> </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card" data-aos="zoom-in" data-aos-delay="300">
              <i class="bi bi-credit-card-2-front-fill"></i>
              <div class="card-body">
                <h5 class="card-title">Transfert rapide</h5>
                <p class="card-text">Transférer de l’argent via Linc n’est qu’une question de moments.</p>
                <a href="#" class="readmore"> </a>
              </div>
            </div>
          </div>

        </div>



      </div>
    </section>
    
<!-- Feature Section  -->
<!--<div class="section features-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="mt-0 mb-4 text-center">
                    {{ @$content->data_values->heading }}
                </h3>
            </div>
        </div>
        <div class="row g-4 g-md-3 justify-content-center">




            @foreach ($features as $feature)
                <div class="col-md-4">
                    <div class="features-card flex-column flex-xl-row justify-content-center text-xl-start align-items-xl-center text-center">
                        <div class="icon icon--circle icon--xl bg--base text--white mx-auto flex-shrink-0">
                            @php
                                echo $feature->data_values->icon;
                            @endphp
                        </div>
                        <div class="features-card__content">
                            <h5 class="mt-0 mb-2">
                                {{ __($feature->data_values->title) }}
                            </h5>
                            <p class="mb-0">
                                {{ __($feature->data_values->description) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> -->
