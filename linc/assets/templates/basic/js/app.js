(function ($) {
  "use strict";

  $(document).ready(function () {
    // Mobile Menu Dropdown
    const mobileNavToggler = document.querySelector(".nav--toggle");
    const body = document.querySelector("body");
    if (mobileNavToggler) {
      mobileNavToggler.addEventListener("click", function () {
        body.classList.toggle("nav-toggler");
      });
    }
    // Mobile Menu Dropdown End

    // Mobile Submenu
    $(".primary-menu__list.has-sub .primary-menu__link").on(
      "click",
      function (e) {
        e.preventDefault();
        body.classList.add("primary-submenu-toggler");
      }
    );
    $(".primary-menu__list.has-sub.active .primary-menu__link").on(
      "click",
      function (e) {
        e.preventDefault();
        body.classList.remove("primary-submenu-toggler");
      }
    );
    $(".primary-menu__list.has-sub").on("click", function () {
      $(this).toggleClass("active").siblings().removeClass("active");
    });
    // Mobile Submenu End

    // Search Popup
    var bodyOvrelay = $("#body-overlay");
    var searchPopup = $("#search-popup");

    $(document).on("click", "#body-overlay", function (e) {
      e.preventDefault();
      bodyOvrelay.removeClass("active");
      searchPopup.removeClass("active");
    });
    $(document).on("click", ".search--toggler", function (e) {
      e.preventDefault();
      searchPopup.addClass("active");
      bodyOvrelay.addClass("active");
    });
    // Search Popup End

    // Magnific Popup
    var magPhoto = $(".show-video");
    if (magPhoto.length) {
      magPhoto.magnificPopup({
        disableOn: 700,
        type: "iframe",
        mainClass: "mfp-fade",
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        disableOn: 300,
      });
    }
    // Magnific Popup End

    // Feedback Slider
    let feedbackSlider = $(".feedback-slider");
    if (feedbackSlider) {
      feedbackSlider.slick({
        mobileFirst: true,
        arrows: false,
        autoplay: true,
        slidesToShow: 1,
        autoplaySpeed: 1000,
        speed: 2000,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 3,
              centerMode: true,
            },
          },
        ],
      });
    }
    // Feedback Slider End

    // Client Slider
    let clientSlider = $(".client-slider");
    if (clientSlider) {
      clientSlider.slick({
        mobileFirst: true,
        arrows: false,
        autoplay: true,
        slidesToShow: 1,
        autoplaySpeed: 1000,
        speed: 2000,
        responsive: [
          {
            breakpoint: 539,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 3,
            },
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 4,
            },
          },
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 5,
            },
          },
          {
            breakpoint: 1399,
            settings: {
              slidesToShow: 6,
            },
          },
        ],
      });
    }
    // Client Slider End

    // Counter Up by Odometer
    let counterUp = $(".counter-up");
    if (counterUp) {
      counterUp.each(function () {
        $(this).isInViewport(function (status) {
          if (status === "entered") {
            for (
              var i = 0;
              i < document.querySelectorAll(".odometer").length;
              i++
            ) {
              var el = document.querySelectorAll(".odometer")[i];
              el.innerHTML = el.getAttribute("data-odometer-final");
            }
          }
        });
      });
    }
    // Counter Up by Odometer End

    // Password Show Hide Toggle
    let passTypeToggle = $(".pass-toggle");
    if (passTypeToggle) {
      passTypeToggle.each(function () {
        $(this).on("click", function () {
          $(this)
            .children()
            .toggleClass("las la-eye-slash")
            .toggleClass("las la-eye");
          var input = $(this).parent().find("input");
          if (input.attr("type") == "password") {
            input.attr("type", "text");
          } else {
            input.attr("type", "password");
          }
        });
      });
    }
    // Password Show Hide Toggle End

    // Animate the scroll to top
    $(".back-to-top").on("click", function (event) {
      event.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, 300);
    });
    // Animate the scroll to top End
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Receiving mode change
    let radios = $(".receiving__radio");

    radios.click(function () {
      let content = $("#content_" + this.value);

      content.removeClass("none");
      content.siblings().each((i, element) => {
        element.classList.add("none");
      });
    });
    // Receiving mode change end

    // operator select change
    $(".operation__select").change(function (e) {
      e.preventDefault();

      let operator = $(".operator__image");
      operator.css(
        "background-image",
        "url('/assets/images/mobile/" + this.value + ".png')"
      );
    });

    // check phone number 
    $('#recipient_mobile').keyup(function (e) {
      e.preventDefault()
      let phone_err = $('#phone_error')
      phone_err.addClass('d-none')
        $('#phone_error small').text('')

      let input_val = $('#recipient_mobile').val()
      if (input_val.length) {
        if (input_val.charAt(0) == '0') {
          $('#phone_error small').text('Le numéro de téléphone ne doit pas commencer par 0')
          phone_err.removeClass('d-none')
        } else {
          let operator = $(".operation__select")
          let has_error = false
          if (operator.val() == 'mpesa') {
            if (input_val.charAt(0) != 8) {
              has_error = true
            } else if (input_val.length > 1) {
              if (input_val.charAt(1) != 1 && input_val.charAt(1) != 2 && input_val.charAt(1) != 3) {
                has_error = true
              }
            } else if (input_val.length > 9) {
              has_error = true
            } 

            if (has_error) {
              $('#phone_error small').text('Le numéro saisi n\'est pas un numéro Vodacom valide')
              phone_err.removeClass('d-none')
            } else {
              phone_err.addClass('d-none')
            }
          } else if (operator.val() == 'orangemoney') {
            if (input_val.charAt(0) != 8) {
              has_error = true
            } else if (input_val.length > 1) {
              if (input_val.charAt(1) != 9 && input_val.charAt(1) != 5 && input_val.charAt(1) != 0) {
                has_error = true
              }
            } else if (input_val.length > 9) {
              has_error = true
            } 

            if (has_error) {
              $('#phone_error small').text('Le numéro saisi n\'est pas un numéro Orange valide')
              phone_err.removeClass('d-none')
            } else {
              phone_err.addClass('d-none')
            }
          } else if (operator.val() == 'airtelmoney') {
            if (input_val.charAt(0) != 9) {
              has_error = true
            } else if (input_val.length > 1) {
              if (input_val.charAt(1) != 9 && input_val.charAt(1) != 7) {
                has_error = true
              }
            } else if (input_val.length > 9) {
              has_error = true
            } 

            if (has_error) {
              $('#phone_error small').text('Le numéro saisi n\'est pas un numéro Airtel valide')
              phone_err.removeClass('d-none')
            } else {
              phone_err.addClass('d-none')
            }
          } else if (operator.val() == 'afrimoney') {
            if (input_val.charAt(0) != 9) {
              has_error = true
            } else if (input_val.length > 1) {
              if (input_val.charAt(1) != 0) {
                has_error = true
              }
            } else if (input_val.length > 9) {
              has_error = true
            } 

            if (has_error) {
              $('#phone_error small').text('Le numéro saisi n\'est pas un numéro Africell valide')
              phone_err.removeClass('d-none')
            } else {
              phone_err.addClass('d-none')
            }
          } 

        }
      }
    })
  });
})(jQuery);

// Header Fixed On Scroll

var bodySelector = document.querySelector("body");
const header = document.querySelector(".header-fixed");

if (bodySelector.contains(header)) {
  const headerTop = header.offsetHeight;
  function fixHeader() {
    if (window.scrollY >= headerTop) {
      document.body.classList.add("fixed-header");
    } else if (window.scrollY <= headerTop) {
      document.body.classList.remove("fixed-header");
    } else {
      document.body.classList.remove("fixed-header");
    }
  }
  $(window).on("scroll", function () {
    fixHeader();
  });
}

// Header Fixed On Scroll End
$(window).on("scroll", function () {
  var ScrollTop = $(".back-to-top");
  if ($(window).scrollTop() > 1200) {
    ScrollTop.fadeIn(1000);
  } else {
    ScrollTop.fadeOut(1000);
  }
});

$(window).on("load", function () {
  // Preloader
  var preLoder = $(".preloader");
  preLoder.fadeOut(300);
});
$.each($("input, select, textarea"), function (i, element) {
  if (element.hasAttribute("required")) {
    $(element)
      .closest(".form-group")
      .find("label")
      .first()
      .addClass("required");
  }
});
 