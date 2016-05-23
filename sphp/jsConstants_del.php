<?php

namespace Sphp\Js;

const JS_PATHS        = "jsPAths";

const JQUERY          = 0b0001;
const QTIP            = 0b0011;
const ION_RANGESLIDER = 0b0101;
const ANYTIME_C       = 0b1001;

const MODERNIZR       = 0b0010000;
const FAST_CLICK      = 0b0100000;
const FOUNDATION      = 0b0110001;
const ZERO_CLIPBOARD  = 0b1000000;

const SPHP_ALL        = 0b11111111;

use Sphp\System\Config as Config;

$jsConfig = Config::obtain(__NAMESPACE__);

$jsConfig[FAST_CLICK] = "fastclick.min.js";
$jsConfig[MODERNIZR] = "modernizr.min.js";
$jsConfig[JQUERY] = "jquery.min.js";
$jsConfig[FOUNDATION] = "foundation.min.js";
$jsConfig[QTIP] = "qtip.min.js";
$jsConfig[ION_RANGESLIDER] = "ion.rangeSlider.min.js";
$jsConfig[ANYTIME_C] = "anytime.c.min.js";
$jsConfig[ZERO_CLIPBOARD] = "ZeroClipboard.min.js";
$jsConfig[SPHP_ALL] = "sphp.min.js";

echo Config::obtain(__NAMESPACE__);
