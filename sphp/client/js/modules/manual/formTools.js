
class SphpFormExampleModal {
  modalId = 'foo';
  constructor(modalId) {
    this.modalId = modalId;
    this.insertModalIntoBody();
  }
  get modalId() {
    return this.modalId;
  }
  modalExists() {
    return $('#' + this.modalId).length > 0;
  }
  insertModalIntoBody() {
    if (!this.modalExists()) {
      this.modal = $('<div class="modal fade" id="' + this.modalId + '" tabindex="-1">'
              + '<div class="modal-dialog">'
              + '<div class="modal-content">'
              + '<div class="modal-header">'
              + '<h5 class="modal-title">Form submission data:</h5>'
              + '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close Submission data modal"></button>'
              + '</div>'
              + '<div class="modal-body"></div>'
              + '<div class="modal-footer">'
              + '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'
              + '</div></div></div></div>');

      $('body').append(this.modal);
    } else {
      this.modal = $('#' + this.modalId);
    }
  }

  insertVars(formValues) {
    const $body = this.modal.find('.modal-body');
    $body.html(formValues);

  }

  makeTrigger(htmlObject) {
    htmlObject.attr('data-bs-toggle', 'modal');
    htmlObject.attr('data-bs-target', '#' + this.modalId);
    return htmlObject;
  }

}
class FormSubmissionDataView {

  constructor(form) {
    this.form = form;
  }
  createLi(inputDataRow) {
    console.log('createLi() with data:');
    console.log(inputDataRow);
    var $li = $('<li>'), $strong = $('<strong>'), $var = $('<var>');
    $var.html(inputDataRow.value);
    $strong.html(inputDataRow.name + ': ');
    $li.append($strong);
    $li.append($var);
    return $li;
  }
  getSubmission() {
    let array = this.form.serializeArray();
    var $list = $('<ul class="data-list">');
    for (let  $i = 0; $i < array.length; $i++) {
      $list.append(this.createLi(array[$i]));

    }
    return $list;
  }
}
(function ($) {
  'use strict';

  $.fn.insertDemoSubmitter = function () {

    return this.each(function () {
      console.log("insertDemoSubmitter:");
      const $modal = new SphpFormExampleModal('sphp-fprm-example-modal');
      var $form = $(this);
      const $formSubmissionDataView = new FormSubmissionDataView($form);

      var $submitter = $modal.makeTrigger($('<button type="button" class="btn btn-danger m-2">See submission data</button>'));
      let $div;
      $div = $('<div class="alert alert-danger form-submission-row mx-2 my-2"></div>');
      $div.append('<strong class="m-1">This row is automatically generated for form submission data viewing purposes</strong><hr>');
      $div.append($submitter);

      $form.append($div);
      $form.submit(function () {
        console.log("Form submiting trapped");
        return false;
      });
      $submitter.click(function () {
        console.log("$submitter clicked");
        $modal.insertVars($formSubmissionDataView.getSubmission());
        return false;
      });
    });
  };

}(jQuery));

$(document).ready(function () {
  'use strict';
  $(".form-example form").insertDemoSubmitter();

});
