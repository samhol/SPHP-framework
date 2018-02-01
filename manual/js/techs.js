
$(document).ready(function () {
  var $output = $("#ooo");
  $(".sphp-tech-slick svg").on("click", function () {
    var $this = $(this),
    $obj = $this.attr("data-tech");
    $output.load("manual/snippets/techs.php #" + $obj);
  });
  $(".sphp-slick svg.js").on("click", function () {
    $output.load("manual/snippets/techs/js.php");
  });
  $("#contact").on("click", function () {
    $output.load("../pages/theContactPage.html");
  });
});
