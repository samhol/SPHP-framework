$(function () {

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
    ]
  });

});


