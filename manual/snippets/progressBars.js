
var foo = {
  initBar: function ($barName) {
    $(document).ready(function () {
      var bar = sphp.Foundation.getProgressBar($barName);
      bar.on("sphp.progressBar.change", function (event) {
        $theBar = $(event.delegateTarget);
        $progress = $theBar.getProgress();
        $add = Math.floor((Math.random() * 10) + 5);
        foo.setBar($theBar, $progress + $add);
      });
      bar.setProgress(0);
    });
  },
  setBar: function ($bar, $progress) {
    setTimeout(function () {
      if ($progress <= 100) {
        $bar.setProgress($progress);
      } else {
        $bar.setProgress(0);
      }
    }, 500);
  }
};
foo.initBar("foobar");

