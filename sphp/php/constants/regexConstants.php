<?php

namespace Sphp\Regex;

const NUMBERS_ONLY = '/^[0-9]+$/';
const TIME = '/^(([0-9])|([0-1][0-9])|([2][0-3]))[:.,;](([0-9])|([0-5][0-9]))$/';
const YEAR = '/^(19|20)([0-9]{1,2})$/'; //

namespace Sphp\Regex\US;

/**
 * Regular Expression for valid US zipcode
 */
const ZIPCODE = '/^\d{5}(\-\d{4})?$/';

namespace Sphp\Regex\SWE;

/**
 * Regular Expression for valid Swedish zipcode
 */
const ZIPCODE = '/^(s-|S-){0,1}[0-9]{3}\s?[0-9]{2}$/';

namespace Sphp\Regex\FR;

/**
 * Regular Expression for valid French alphabets
 */
const ALPHABETS_ONLY = '/^[a-zA-ZàâäôéèëêïîçùûüÿæœÀÂÄÔÉÈËÊÏÎŸÇÙÛÜÆŒ]+$/';

/**
 * Regular Expression for valid French alphanumerics
 */
const ALPHANUMERICS_ONLY = '/^([0-9a-zA-ZàâäôéèëêïîçùûüÿæœÀÂÄÔÉÈËÊÏÎŸÇÙÛÜÆŒ])*$/';

namespace Sphp\Regex\EN;

/**
 * Regular Expression for valid English alphabets
 */
const ALPHABETS_ONLY = '/^[a-zA-Z]+$/';

/**
 * Regular Expression for valid English alphanumerics
 */
const ALPHANUMERICS_ONLY = '/^([0-9a-zA-Z])*$/';

namespace Sphp\Regex\UK;

/**
 * Regular Expression for valid United Kingdom zipcode
 */
const ZIPCODE = '/^(([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) [0-9][A-Za-z]{2}))$/ui';

namespace Sphp\Regex\FI;

/**
 * Regular Expression for valid Finnish alphabets
 */
const ALPHABETS_ONLY = '/^[a-zA-ZäöåÄÖÅ]+$/';

/**
 * Regular Expression for valid Finnish alphanumerics
 */
const ALPHANUMERIC_ONLY = '/^([0-9a-zA-ZäöåÄÖÅ])*$/';

/**
 * Regular Expression for Finnish person name
 */
const NAME = '/^([a-zA-ZäöåÄÖÅ\ \-])*$/';

/**
 * Regular Expression for valid Finnish zipcode
 */
const ZIPCODE = '/^\d{5}$/';

/**
 * Regular Expression for valid Finnish date
 */
const DATE = '/^([0-9]{1,2})[\.]([0-9]{1,2})[\.](19|20)([0-9]{1,2})$/';
const PHONENUMBER = '/^\+?\d{2}[\d\ -]{3,14}$/';

