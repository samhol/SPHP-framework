

var exampleModal = document.getElementById('icon-modal');
if (exampleModal !== null) {

  exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var $button = $(event.relatedTarget);
    var $modal = $(exampleModal),
            $url = $button.attr('data-sphp-url'),
            $titleUrl = $url,
            $target = $modal.find('.modal-body'),
            $title = $modal.find('.modal-title');
    console.log("\tIcon Group trigger (" + $modal.attr('id') + ") clicked");
//  $button.addClass('active');
    //var modalTitle = exampleModal.querySelector('.modal-title');
    if (!$titleUrl.includes('?')) {
      $titleUrl = $titleUrl + '?title';
    } else {
      $titleUrl = $titleUrl + '&title';
    }
    $title.html('<strong>Icons are loading...</strong>');
    $title.load($titleUrl,
            function (response, status, xhr) {
              if (status === "error") {
                var msg = "Sorry but there was an error: ";
                $title.html(msg + xhr.status + " " + xhr.statusText);
                console.error("loading URL(" + $url + ") failed");
              } else {
                console.log("loading URL(" + $url + ") successfull");
                // $target.foundation();
                //  $target.find("[data-src]").lazyLoadXT({scrollContainer: $target.parent()});
                // $app.initIconGroupInfo($target.find('[data-sphp-url]'));
              }
            });
    // var modalBody = exampleModal.querySelector('.modal-body');
    $target.html('<strong>Icons are loading...</strong><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
    $target.load($url,
            function (response, status, xhr) {
              if (status === "error") {
                var msg = "Sorry but there was an error: ";
                $target.html(msg + xhr.status + " " + xhr.statusText);
                console.error("loading URL(" + $url + ") failed");
              } else {
                console.log("loading URL(" + $url + ") successfull");
                var $search = $target.find('[data-sphp-search]');
                var $dt = [];
                $search.each(function (index) {
                  console.log(index + ": " + $(this).attr('data-sphp-search'));
                });
//console.table($search);
                // $target.foundation();
                //  $target.find("[data-src]").lazyLoadXT({scrollContainer: $target.parent()});
                // $app.initIconGroupInfo($target.find('[data-sphp-url]'));
              }
            });
    //modalTitle.textContent = 'New message to ' + recipient;
  });


}
function finder() {
  $('[name=find-icon]');
}
 
