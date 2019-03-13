$(function () {
  //$('.sphp-tech-slick').children('svg').hide();


  $('#tech-info').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    cssEase: 'linear',
    //adaptiveHeight: true,
    asNavFor: '#tech-icons'
  });

  $('#tech-icons').slick({
    dots: true,
    infinite: true,
    speed: 300,
    //autoplay: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '#tech-info',
    centerMode: true,
    focusOnSelect: true,
    //centerPadding: '60px',
    variableWidth: true,
    responsive: [
      {
        breakpoint: 1440,
        settings: {
          //slidesToShow: 5,
          dots: true
        }
      },
      {
        breakpoint: 1200,
        settings: {
          //slidesToShow: 4,
          dots: true
        }
      },
      {
        breakpoint: 1024,
        settings: {
          //slidesToShow: 3,
          dots: false,
        }
      },
      {
        breakpoint: 640,
        settings: {
         // slidesToShow: 1,
          dots: false,
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
  /*var $output = $("#explanation");
  $(".sphp-tech-slick .sphp-info-button").on("click", function () {
    var $this = $(this), $div,
            $obj = $this.attr("data-tech");
    $output.load("samiholck/templates/carousels/content/skills-parsed.php #" + $obj);
    $this.addClass('sphp-is-active');
    console.log('sphp-is-active : ' + $obj);
    $this.siblings().removeClass('sphp-is-active');
    //$div = $('#info-modal');
    //$div.centerTo($('body main'), true);
  });*/

});










