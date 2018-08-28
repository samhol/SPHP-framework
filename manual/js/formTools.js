//var a = 0;
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
      $submit = $form.find("button.submitter");
      $submit.attr("data-toggle", $id);
      $submit.attr("data-options", "align:bottom");
      $dropdown = $('<div id="' + $id + '" class="dropdown-pane form-submission-viewer" data-dropdown></div>');
      console.log("dropdown id: " + $id);
      $form.after($dropdown);
      var options = {closeOnClick: true};
      new Foundation.Dropdown($dropdown, options);
      $submit.submit(function () {
        console.log("Handler for .submit() called.");
        return false;
      });
      $submit.click(function () {
        console.log("POSTING TO: " + "manual/snippets/formSubmit.php");
        var posting = $.post("manual/snippets/formSubmit.php", $form.serialize());

        console.log("submit data insertion:");
        // Put the results in a div
        posting.done(function (data) {
          console.log("done inserting: ");
          console.log(data);
          $dropdown.empty().append(data);
        });
        posting.fail(function () {
          console.log("error");
          $dropdown.empty().append('<h4>Can not submit the form</h4>');
        });
      });
    });
  };
  $.fn.insertDemoSubmitter = function () {
    return this.each(function () {
      console.log("insertDemoSubmitter:");
      var $form = $(this), $get;
      $get = $.get("manual/ajax/submitRow.php");
      $form.submit(function () {
        console.log("Form submiting trapped");
        return false;
      });
      $get.done(function (data) {
        console.log("insertDemoSubmitter done");
        $form.append(data);
        console.log("done inserting: ");
        console.log(data);
        $form.submitViewer();

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
  $(".form-example form").insertDemoSubmitter();
  $(".grid-example .columns").insertClassToTitle();

});
