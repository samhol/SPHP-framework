
var foo = {
  bar: function ($barName) {
    var $bar = sphp.Foundation.getProgressBar($barName),
            $button = $('<button class="button">Progress: <span>' + $bar.getProgress() + '</span>%, Click to change!</button>');
    $button.insertAfter($bar);
    $button.click(function () {
      var $progress = $bar.getProgress() + 5;
      foo.setProgress($bar, $progress);
    });
    $bar.on("sphp.progressBar.change", function (event) {
      $theBar = $(event.delegateTarget);
      $button = $theBar.next("button");
      $button.find("span").html($theBar.getProgress());
    });
  },
  setProgress: function ($bar, $progress) {
    if ($progress > 100) {
      $bar.setProgress(0);
    } else {
      $bar.setProgress($progress);
    }
  }
};
foo.bar("foobar1");
foo.bar("foobar2");

