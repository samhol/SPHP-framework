$(function () {
  var header = $(".navbar.sphp");
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 200) {
      //console.log(scroll);
      header.addClass("scrolled");
    } else {
      header.removeClass("scrolled");
    }
  });
});
