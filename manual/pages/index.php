<?php

namespace Sphp\Html;

echo $parsedown->text(<<<EOD
#INTRODUCTION

SPHP framework is an open source framework for developing interactive web applications
and services in object oriented PHP. 

The `SPHP` abreviation is a combination of my name `S`ami `P`etteri `H`olck and `P`HP: hypertext preprosessor.
      
###SYSTEM REQUIREMENTS

Framework requires PHP 5.5 or later; it is recommended to use the latest stable PHP version whenever possible.

Download the framework package from [github](https://github.com/samhol/SPHP) and Install it with Composer:

* [Composer installation](https://getcomposer.org/download/){target="_blank"}
* [Composer Documentation](https://getcomposer.org/doc/){target="_blank"}

EOD
);

$load("Sphp.Html.Media-Orbit-intro.php");
$load("Sphp.Html.Foundation-orbit-intro.php");
