/**
 * 
 * @param {namespace} sphp
 * @param {type} $
 * @param {undefined} undefined
 * @returns {undefined}
 */
(function (sphp, $, undefined) {

  'use strict';

  sphp.initReCAPTCHAv3sForm = function () {
    console.log("run initReCAPTCHAv3sForm");
    var $form = $("form[data-sphp-grecaptcha-v3]");
    var $submitBtn = $form.find("button.submitter");
    var $formId = $form.attr('id'), $clientId = $form.attr('data-sphp-grecaptcha-v3-clientId');
    $submitBtn.click(function () {
      insertCaptha();
    });

    /**
     * Sets the captha input to the form
     * 
     * @param {string} $name
     * @param {string} $value
     */
    function setCapthaInput($name, $value) {
      var $input = $form.find('input[name="' + $name + '"]');
      if ($input.length === 0) {
        console.log("insert recaptcha input to form");
        $input = $('<input type="hidden" name="' + $name + '">');
        $form.prepend($input);
      }
      $input.val($value);
    }

    function insertCaptha() {
      if (typeof grecaptcha === "undefined") {
        throw "Google grecaptcha object is not defined";
      }
      grecaptcha.ready(function () {
        grecaptcha.execute($clientId, {action: $formId}).then(function (token) {
          setCapthaInput("g-recaptcha-response", token);
          $form.submit();
        });
      });
    }

  };

}(window.sphp = window.sphp || {}, jQuery));

