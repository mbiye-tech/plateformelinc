@php
$aboutContent = getContent('about.content', true);
$aboutElement = getContent('about.element', false, null, true);
@endphp
<!-- about  -->

<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.4/font/bootstrap-icons.min.css" integrity="sha512-yU7+yXTc4VUanLSjkZq+buQN3afNA4j2ap/mxvdr440P5aW9np9vIr2JMZ2E5DuYeC9bAoH9CuCR7SJlXAa4pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>

<style>
        
@media (min-width: 1024px) {
   
    /* bouncing effect */
    .bounce {
        animation: bounce 2s infinite alternate;
        -webkit-animation: bounce 2s infinite alternate;
    }
    @keyframes bounce {
        from {
            transform: translateY(0px);
        }
        to {
            transform: translateY(-35px);
        }
    }
    @-webkit-keyframes bounce {
        from {
            transform: translateY(0px);
        }
        to {
            transform: translateY(-35px);
        }
    }
   
}

#hero {
  width: 100%;
  position: relative; 
  background: url("assets/images/img/hero-bg.png") center bottom no-repeat;
  background-size: cover;
  padding: 200px 0 120px 0;
}

@media (max-width: 991px) {
  #hero {
    padding: 140px 0 60px 0;
  }
}

@media (max-width: 574px) {
  #hero {
    padding: 100px 0 20px 0;
  }
}

#hero .hero-img {
  width: 50%;
  float: right;
}

@media (max-width: 991px) {
  #hero .hero-img {
    width: 80%;
    float: none;
    margin: 0 auto 25px auto;
  }
}

#hero .hero-info {
  width: 50%;
  float: left;
}

@media (max-width: 991px) {
  #hero .hero-info {
    width: 80%;
    float: none;
    margin: auto;
    text-align: center;
  }
}

@media (max-width: 767px) {
  #hero .hero-info {
    width: 100%;
  }
}

#hero .hero-info h2 {
  color: #fff;
  margin-bottom: 40px;
  font-size: 48px;
  font-weight: 700;
}

#hero .hero-info h2 span {
  color: #74b5fc;
  text-decoration: none;
 
}


@media (max-width: 767px) {
  #hero .hero-info h2 {
    font-size: 34px;
    margin-bottom: 30px;
  }
}

#hero .hero-info .btn-get-started,
#hero .hero-info .btn-services {
  font-family: "Montserrat", sans-serif;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: 1px;
  display: inline-block;
  padding: 10px 32px;
  border-radius: 50px;
  transition: 0.5s;
  margin: 0 20px 20px 0;
  color: #fff;
  text-decoration: none;
    
    
}

#hero .hero-info .btn-get-started {
  background: #007bff;
  border: 2px solid #007bff;
  color: #fff;
  text-decoration: none;
    
}

#hero .hero-info .btn-get-started:hover {
  background: none;
  border-color: #fff;
  color: #fff;
}

#hero .hero-info .btn-services {
  border: 2px solid #fff;
}

#hero .hero-info .btn-services:hover {
  background: #007bff;
  border-color: #007bff;
  color: #fff;
}


.about .content h3 {
  font-weight: 600;
  font-size: 26px;
}

.about .content ul {
  list-style: none;
  padding: 0;
}

.about .content ul li {
  padding-left: 28px;
  position: relative;
}

.about .content ul li+li {
  margin-top: 10px;
}

.about .content ul i {
  position: absolute;
  left: 0;
  top: 2px;
  font-size: 20px;
  color: #47b2e4;
  line-height: 1;
}

.about .content p:last-child {
  margin-bottom: 0;
}

.about .content .btn-learn-more {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 14px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 12px 32px;
  border-radius: 4px;
  transition: 0.3s;
  line-height: 1;
  color: #47b2e4;
  animation-delay: 0.8s;
  margin-top: 6px;
  border: 2px solid #47b2e4;
  text-decoration:none;
    
}

.about .content .btn-learn-more:hover {
  background: #47b2e4;
  color: #fff;
  text-decoration: none;
}


.section-title {
  text-align: center;
  padding-bottom: 30px;
}

.section-title h2 {
  font-size: 32px;
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 20px;
  padding-bottom: 0;
  color: #054a85;
}

.section-title p {
  margin-bottom: 0;
  font-style: italic;
}



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
    
    
    

<div class="section ">
    
    <div class="container">
        <div class="row g-4 align-items-center">
            
            <div class="col-lg-6 col-xl-7">
                <div class="me-xxl-4">

                        <img src="{{ getImage('assets/images/img/linc.png') }}" class="bounce" alt=""> 

                </div>
            </div>

            <div class="col-lg-6 col-xl-5">
                <h3 class="mt-0">{{ __($aboutContent->data_values->heading) }}</h3>
                <p class="section__para">
                    {{ __($aboutContent->data_values->description) }}
                </p>
                <hr/>
                <div class="row g-4">
                    <h5 class="mt-4">{{ __("WHAT WE VALUE") }}</h5>
                    <p style="margin-top:0" class="section__para">
                        {{ __("From our earliest beginnings, we have put technology to work connecting people. As technology has advanced, so have we—but always with our focus on connecting people with the places and loved ones that matter most to them, in good times and bad.") }}
                    </p>
                </div>
            </div>
            
           <!-- 
            <div class="row">
                <div class="col-md-12" style="margin-top: 70px;text-align:center">
                        <hr/>
                    @foreach ($aboutElement as $item)
                        <div>
                            {!! __($item->data_values->feature_item) !!}
                        </div>
                        <hr/>
                    @endforeach
                </div>
                
                
                
            </div> -->
            
            

        </div>
        
        
    </div>
</div>


            <section id="hero" class="clearfix">
    <div class="container" data-aos="fade-up">

      <div class="hero-img" data-aos="zoom-out" data-aos-delay="200">

        <img src="{{ getImage('assets/images/img/about-removebg-preview.png') }}" alt="" class="img-fluid">
      </div>

      <div class="hero-info" data-aos="zoom-in" data-aos-delay="100">
        <h2>Linc Pay </br><span>solutions</span><br>Transaction Sécurisée </h2>
        <div>
          <a href="#about" class="btn-get-started scrollto">Voir Plus</a>
          <a href="#services" class="btn-services scrollto">Plus des possibilité </a>
        </div>
      </div>

    </div>
  </section>
  
  
 
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Linc Pay </h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
                
                @lang('Trusting us is your guarantee when it comes to your transactions, so do not hesitate to open an account with us and make your transactions')</p>
            <ul>
              <li><i class="ri-check-double-line"></i> @lang('Available throughout the Democratic Republic of Congo and around the world')</li>
              <li><i class="ri-check-double-line"></i>@lang('Linc vous offrez des services de qualité en ce qui concerne le mobile money et consort')</li>
              <li><i class="ri-check-double-line"></i> Facile et simple à utilisez</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
             Nous offrons des meilleurs taux de change et des frais moins élevés que la plupart des banques et des services de transfert d'argent conventionnels.
            </p>
            <a href="#" class="btn-learn-more">Lire Plus </a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->



    <section id="why-us">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h3>Services</h3>
          <p>Recevez de l'argent de n'importe quel pays du monde et Transférez de l'argent dans le monde entier à des frais réduits.</p>
        </header>

        <div class="row row-eq-height justify-content-center">

          <div class="col-lg-4 mb-4">
            <div class="card" data-aos="zoom-in" data-aos-delay="100">
              <i class="bi bi-calendar4-week"></i>
              <div class="card-body">
                <h5 class="card-title">Envoyer une demande d'argent</h5>
                <p class="card-text">Au début, vous devez soumettre les informations requises à partir de la page d'envoi d'argent pour émettre une demande d'envoi d'argent.</p>
                <a href="#" class="readmore">Lire Plus</a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card" data-aos="zoom-in" data-aos-delay="200">
              <i class="bi bi-credit-card-fill"></i>
              <div class="card-body">
                <h5 class="card-title">  @lang('Effectuer le paiement')
                    </h5>
                <p class="card-text">Après avoir soumis la demande d'envoi d'argent, vous devez terminer le processus de paiement par un mode de paiement.</p>
                <a href="#" class="readmore">Lire Plus </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card" data-aos="zoom-in" data-aos-delay="300">
              <i class="bi bi-credit-card-2-front-fill"></i>
              <div class="card-body">
                <h5 class="card-title">@lang('The recipient receives a notification')</h5>
                <p class="card-text">Une fois le processus de paiement terminé, votre destinataire en sera informé</p>
                <a href="#" class="readmore">Lire Plus </a>
              </div>
            </div>
          </div>

        </div>



      </div>
    </section>
    

