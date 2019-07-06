/**
 * 
 * @param {namespace} sphp
 * @param {object} $
 * @param {undefined} undefined
 * @returns {undefined}
 */
(function (sphp, $, undefined) {
  'use strict';

  sphp.setFoundationAbideAddons = function () {

    Foundation.Abide.defaults.patterns['fi_dob'] = /^(0?[1-9]|[12][0-9]|3[01])[- \/.](0?[1-9]|1[012])[- \/.](19|20)\d{2}$/;
    Foundation.Abide.defaults.patterns['ger_alpha'] = /^[a-zäöüßA-ZÄÖÜ]+$/;
    Foundation.Abide.defaults.patterns['ger_alpha_numeric'] = /^[a-zäöüßA-ZÄÖÜ0-9]+$/;
    Foundation.Abide.defaults.patterns['fi_alpha'] = /^[a-zäöåA-ZÅÄÖ]+$/;
    Foundation.Abide.defaults.patterns['fi_alpha_numeric'] = /^[a-zåäöA-ZÅÄÖ0-9]+$/;
    Foundation.Abide.defaults.patterns['finnish_municipalities'] = /^[a-zåäöA-ZÅÄÖ]+(([ -][a-zåäöA-ZÅÄÖ ])?[a-zåäöA-ZÅÄÖ]*)*$/;
    Foundation.Abide.defaults.patterns['person_name'] = /^[a-zåäöüA-ZÅÄÖÜ]+(([',. -][a-zåäöüA-ZÅÄÖÜ ])?[a-zåäöüA-ZÅÄÖÜ]*)*$/;
    Foundation.Abide.defaults.patterns['d-m-y'] = /^(0?[1-9]|[12][0-9]|3[01])[- \/.](0?[1-9]|1[012])[- \/.]\d{4}$/;
    Foundation.Abide.defaults.patterns['phone'] = /^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,3})|(\(?\d{2,3}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/;
  };

}(window.sphp = window.sphp || {}, jQuery));

