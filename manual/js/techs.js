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
  var $allToggler = $('div[data-switch-board] [data-toggle-all]');
  $allToggler.click(function () {
    $('div[data-switch-board] input[type="checkbox"]').prop('checked', this.checked)
  })
  $('div[data-switch-board] section input[type="checkbox"]').click(function () {
    if ($('div[data-switch-board] section input:checked').length === $('div[data-switch-board] section input[type="checkbox"]').length) {
      $allToggler.prop('checked', true);
      console.log('all checked');
    } else{
      $allToggler.prop('checked', false);    
      console.log('not all checked');
    }
  })
});










