/**
 * 
 * @param {namespace} sphp
 * @param {type} $
 * @param {undefined} undefined
 * @returns {undefined}
 */
(function (sphp, $, undefined) {
  'use strict';

  sphp.setFoundationAbideAddons = function () {
    Foundation.Abide.defaults.patterns['phone'] = /^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,3})|(\(?\d{2,3}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/;
  };

}(window.sphp = window.sphp || {}, jQuery));

