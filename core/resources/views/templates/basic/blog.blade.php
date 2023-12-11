@extends($activeTemplate . 'layouts.frontend')
@section('content')
    
    

<head>
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.css" integrity="sha512-CWRnZlthFAu05mm4Pu5R/ikDV/2jPo6cgmkpdtBFWUY9/mqNFuTmgwnpBWqDiIeMdn5wv1NEQFdt82/Ak+uzkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" integrity="sha512-cn16Qw8mzTBKpu08X0fwhTSv02kK/FojjNLz0bwp2xJ4H+yalwzXKFw/5cLzuBZCxGWIA+95X4skzvo8STNtSg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    
    
    .section-title {
  text-align: center;
  padding-bottom: 30px;
}

.section-title h2 {
  font-size: 32px;
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 20px;
  padding-bottom: 20px;
  position: relative;
  color:navy;
}

.section-title h2::before {
  content: "";
  position: absolute;
  display: block;
  width: 120px;
  height: 1px;
  background: #ddd;
  bottom: 1px;
  left: calc(50% - 60px);
}

.section-title h2::after {
  content: "";
  position: absolute;
  display: block;
  width: 40px;
  height: 3px;
  background: #47b2e4;
  bottom: 0;
  left: calc(50% - 20px);
}

.section-title p {
  margin-bottom: 0;
}

    .features .feature-box {
  padding: 24px 20px;
  box-shadow: 0px 0 30px rgba(1, 41, 112, 0.08);
  transition: 0.3s;
  height: 100%;
}

.features .feature-box h3 {
  font-size: 18px;
  color: #012970;
  font-weight: 700;
  margin: 0;
}

.features .feature-box i {
  line-height: 0;
  background: #ecf3ff;
  padding: 4px;
  margin-right: 10px;
  font-size: 24px;
  border-radius: 3px;
  transition: 0.3s;
}

.features .feature-box:hover i {
  background: #4154f1;
  color: #fff;
}

.features .feture-tabs {
  margin-top: 120px;
}

.features .feture-tabs h3 {
  color: #012970;
  font-weight: 700;
  font-size: 32px;
  margin-bottom: 10px;
}

@media (max-width: 768px) {
  .features .feture-tabs h3 {
    font-size: 28px;
  }
}

.features .feture-tabs .nav-pills {
  border-bottom: 1px solid #eee;
}

.features .feture-tabs .nav-link {
  background: none;
  text-transform: uppercase;
  font-size: 15px;
  font-weight: 600;
  color: #012970;
  padding: 12px 0;
  margin-right: 25px;
  margin-bottom: -2px;
  border-radius: 0;
}

.features .feture-tabs .nav-link.active {
  color: #4154f1;
  border-bottom: 3px solid #4154f1;
}

.features .feture-tabs .tab-content h4 {
  font-size: 18px;
  margin: 0;
  font-weight: 700;
  color: #012970;
}

.features .feture-tabs .tab-content i {
  font-size: 24px;
  line-height: 0;
  margin-right: 8px;
  color: #4154f1;
}

.features .feature-icons {
  margin-top: 120px;
}

.features .feature-icons h3 {
  color: #012970;
  font-weight: 700;
  font-size: 32px;
  margin-bottom: 20px;
  text-align: center;
}
    
    
    
    @media (max-width: 768px) {
  .features .feature-icons h3 {
    font-size: 28px;
  }
}

.features .feature-icons .content .icon-box {
  display: flex;
}

.features .feature-icons .content .icon-box h4 {
  font-size: 20px;
  font-weight: 700;
  margin: 0 0 10px 0;
  color: #012970;
}

.features .feature-icons .content .icon-box i {
  font-size: 44px;
  line-height: 44px;
  color: #0245bc;
  margin-right: 15px;
}

.features .feature-icons .content .icon-box p {
  font-size: 15px;
  color: #848484;
}


.services .icon-box {
  box-shadow: 0px 0 25px 0 rgba(0, 0, 0, 0.1);
  padding: 50px 30px;
  transition: all ease-in-out 0.4s;
  background: #fff;
}

.services .icon-box .icon {
  margin-bottom: 10px;
}

.services .icon-box .icon i {
  color: #18d26e;
  font-size: 36px;
  transition: 0.3s;
}

.services .icon-box h4 {
  font-weight: 500;
  margin-bottom: 15px;
  font-size: 24px;
}

.services .icon-box h4 a {
  color: navy;
  transition: ease-in-out 0.3s;
    text-decoration: none;

}

.services .icon-box p {
  line-height: 24px;
  font-size: 14px;
  margin-bottom: 0;
}

.services .icon-box:hover {
  transform: translateY(-10px);
}

.services .icon-box:hover h4 a {
  color: #47b2e4;
}


.cta {
  background: navy;
  background-size: cover;
  padding: 120px 0;
}

.cta h3 {
  color: #fff;
  font-size: 28px;
  font-weight: 700;
}

.cta p {
  color: #fff;
}

.cta .cta-btn {
  font-family: "Jost", sans-serif;
  font-weight: 500;
  font-size: 16px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 12px 40px;
  border-radius: 50px;
  transition: 0.5s;
  margin: 10px;
  border: 2px solid #fff;
  color: #fff;
}

.cta .cta-btn:hover {
  background: #47b2e4;
  border: 2px solid #47b2e4;
}

@media (max-width: 1024px) {
  .cta {
    background-attachment: scroll;
  }
}

@media (min-width: 769px) {
  .cta .cta-btn-container {
    display: flex;
    align-items: center;
    justify-content: flex-end;
  }
  
   .cta .cta-btn-container a {
    
    text-decoration: none;
    }
  

}

/*--------------------------------------------------------------
# Why Us
--------------------------------------------------------------*/
.why-us .content {
  padding: 60px 100px 0 100px;
}

.why-us .content h3 {
  font-weight: 400;
  font-size: 34px;
  color: white;
}

.why-us .content h4 {
  font-size: 20px;
  font-weight: 700;
  margin-top: 5px;
}

.why-us .content p {
  font-size: 15px;
  color: white;
}

.why-us .img {
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center center;
}

.why-us .accordion-list {
  padding: 0 100px 60px 100px;
}

.why-us .accordion-list ul {
  padding: 0;
  list-style: none;
}

.why-us .accordion-list li+li {
  margin-top: 15px;
}

.why-us .accordion-list li {
  padding: 20px;
  background: navy;
  border-radius: 4px;
  color: white;
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
  cursor: pointer;
  color: white;
 text-decoration: none;

}

.why-us .accordion-list span {
  color: white;
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
  color: white;
}

.why-us .accordion-list .icon-show {
  display: none;
}

.why-us .accordion-list a.collapsed {
  color: white;
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

  .why-us .content,
  .why-us .accordion-list {
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




</style>

    <div class="section">
    <div class="container-fluid container-restricted">
    <div class="row gy-5 g-lg-4">
    <!-- ======= Services Section ======= -->
   
   
   



    <!-- ======= Details Section ======= -->
    <section id="details" class="details">
      <div class="container">

        <div class="row content">
          <div class="col-md-4" data-aos="fade-right">
            <img src="{{ getImage('assets/images/img/money-removebg-preview.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-4" data-aos="fade-up">
            <h3>Pourquoi les gens nous choisissent pour le transfert d'argent</h3>
            <p class="fst-italic">
Moins cher que votre banque.
            </p>
            <ul>
              <li><i class="bi bi-check"></i> Nous offrons des meilleurs taux de change</li>
              <li><i class="bi bi-check"></i>  des frais moins élevés que la plupart des banques</li>
              <li><i class="bi bi-check"></i> des services de transfert d'argent conventionnels</li>
            </ul>

          </div>
        </div>

        <div class="row content">
          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img src="{{ getImage('assets/images/img/CDF - USD.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
            <h3>Comment recevoir de l'argent</h3>
            <p class="fst-italic">
              Compte banquaire
            </p>
            <p>
              Les bénéficiaires peuvent recevoir les fonds directement sur leurs comptes bancaires en toutes securités sans pourtant se souciez et s'obligez
              de faire un deplacement  </p>
            <p>
              .
            </p>
          </div>
        </div>

        <div class="row content">
          <div class="col-md-4" data-aos="fade-right">
            <img src="{{ getImage('assets/images/img/HandCongolesefranc.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5" data-aos="fade-up">
            <h3>Portefeuil mobile</h3>
            <p>Le portefeuille mobile est un moyen rapide et pratique d’envoyer de l’argent directement sur le téléphone des bénéficiaires</p>
            <ul>
              <li><i class="bi bi-check"></i> Les bénéfciaires peuvent revecoir les tokens</li>
              <li><i class="bi bi-check"></i> qui vont leur permettre de retirer les fonds sans carte au niveau des distributeurs automatique des billets</li>
              <li><i class="bi bi-check"></i> Notre technologie de pointe protège vos transactions</li>
            </ul>

          </div>
        </div>

        <div class="row content">
          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img src="{{ getImage('assets/images/img/Capture-removebg-preview.png') }}" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
            <h3>Envoyez De L'argent À Faible Coût</h3>
            <p class="fst-italic">
              Depuis nos débuts, nous avons mis la technologie au service de la connexion des personnes. Au fur et à mesure que la technologie a progressé, nous aussi, mais toujours en nous concentrant sur la connexion des personnes avec les lieux et les êtres chers qui comptent le plus pour elles, dans les bons comme dans les mauvais moments.
            </p>
           
          </div>
        </div>

      </div>
    </section><!-- End Details Section -->




  <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
            <h3>Envoyer Maintenant </h3>
            <p> Effectuer vos opérations avec rapidité sur toute l'entendue de la republique et partout dans le monde </p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Envoyez Maintenant</a>
          </div>
        </div>

      </div>
    </section><!-- End Cta Section -->




 <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3>Envoyer une demande d'argent</strong></h3>
              <p>
                Au début, vous devez soumettre les informations requises à partir de la page d'envoi d'argent pour émettre une demande d'envoi  
              </p>
            </div>

            <div class="accordion-list">
              <ul>
                <li>
                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Effectuer le paiement  <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                    <p>
                     Aprés avoir soumis la demande d'envoi d'argent, 
                    vous devez terminer le processus de paiement par un mode de paiement
                    </p>
                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Le destinateur reçoit une notification <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                   Une fois le processus de paiment terminé, votre destinateur en sera informé, Notre Technologie de pointe protège vos transactions
                    </p>
                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span>Moins cher que votre banque <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                     Nous offrons des meilleurs taux de change et des 
                    frais moins élevès que la plupart des banques et des services de transfert d'argent conventionnels
                    </p>
                  </div>
                </li>

              </ul>
            </div>

          </div>


        
          <img src="{{ getImage('assets/images/img/CDF - USD.png') }}" class="col-lg-5 align-items-stretch order-1 order-lg-2 img bounce"   data-aos="zoom-in" data-aos-delay="150">
          
          
          </div>

      </div>
    </section>
    
           </div>
        </div>
    </div>
    
    
    
    <!--<div class="section">
        <div class="container">
            <div class="row g-4 g-lg-3 g-xxl-4 justify-content-center">
                @foreach ($blogs as $blog)
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-post">
                            <div class="blog-post__img">
                                <img src="{{ getImage('assets/images/frontend/blog/thumb_' . @$blog->data_values->image, '415x280') }}" alt="{{ __($general->site_name) }}" class="blog-post__img-is">
                                <a href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}" class="t-link blog-post__img-link">
                                    <span class="d-inline-block">
                                        <i class="las la-plus"></i>
                                    </span>
                                </a>
                            </div>

                            <div class="blog-post__body">
                                <ul class="list list--row">
                                    <li class="list--row__item">
                                        <div class="blog-post__meta">
                                            <span class="t-link t-link--base blog-post__meta-text">
                                                {{ $blog->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </li>
                                </ul>

                                <h5 class="mt-3">
                                    <a href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}" class="t-link blog-post__link">
                                        {{ __($blog->data_values->title) }}
                                    </a>
                                </h5>
                                <p>
                                    @php
                                        echo strLimit(strip_tags($blog->data_values->description), 120);
                                    @endphp
                                </p>
                                <a href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}" class="t-link blog-post__btn">
                                    @lang('Read More')
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($blogs->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ paginateLinks($blogs) }}
                </div>
            @endif
        </div>
    </div>-->
    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
