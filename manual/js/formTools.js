(function ($) {
  'use strict';
  $.fn.submitViewer = function () {
    function generateQuickGuid() {
      return Math.random().toString(36).substring(2, 15) +
              Math.random().toString(36).substring(2, 15);
    }
    return this.each(function () {
      console.log("init submitViewer:");
      var $form = $(this),
              $submit,
              $dropdown,
              $id;
      $id = "id_" + generateQuickGuid();
      console.log("submitViewer():");
      //$form.insertSubmisionFunctionality();  
      $submit = $form.find("button.submitter");
      $submit.attr("data-toggle", $id);
      $submit.attr("data-options", "align:bottom");
      $dropdown = $('<div id="' + $id + '" class="dropdown-pane form-submission-viewer" data-dropdown></div>');
      console.log("dropdown id: " + $id);
      $form.after($dropdown);
      var options = {closeOnClick: true};
      var elem = new Foundation.Dropdown($dropdown, options);
      $submit.submit(function () {
        console.log("Handler for .submit() called.");
        return false;
      });
      $submit.click(function () {
        console.log("POSTING TO: " + "manual/snippets/formSubmit.php");
        var posting = $.post("manual/snippets/formSubmit.php", $form.serialize());

        // Put the results in a div
        posting.done(function (data) {
          console.log("done");
          var content = data;
          //console.log(content);
          $dropdown.empty().append(content);
        });
        posting.fail(function () {
          console.log("error");
          $dropdown.empty().append('<h4>Can not submit the form</h4>');
        });
      });
    });
  };
  $.fn.insertSubmisionFunctionality = function () {
    return this.each(function () {
      console.log("insertSubmisionFunctionality:");
      //console.log("URL: "+window.location );
      var $form = $(this),
              $submit, $get;
      $get = $.get("manual/ajax/submitRow.php");
      $get.done(function (data) {
        console.log("done");
        var content = data;
        //console.log(content);
        $form.append(content);
        $form.submitViewer();
        /*$submit = $form.find("[type='submit']");
         $submit.submit(function () {
         console.log("Handler for .submit() called.");
         return false;
         });*/
      });
      $get.fail(function () {
        console.log("error");
        $form.append('<h4>Can not create submit button to the form</h4>');
      });
    });
  };
  $.fn.insertClassToTitle = function () {
    return this.each(function () {
      console.log("insertClassToTitle:");
      var $this = $(this),
              $classes;
     $classes = $this.attr("class");
      $this.attr("title", $classes);
    });
  };
}(jQuery));

$(document).ready(function () {
  'use strict';
  $(".manual.accordion.form-example form, .manual .mainContent>form").insertSubmisionFunctionality();
  $(" .grid-example .columns").insertClassToTitle();
  
});
