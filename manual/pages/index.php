<?php

namespace Sphp\Manual;

md(<<<MD
#SPHP <small>a framework for responsive web developement using PHP</small>
<div class="callout alert" markdown="1">
##What is Responsive Web Design?
Responsive Web Design makes a web page look good and be easy to use on all devices (desktops, tablets, and phones).
Web pages should not leave out information to fit smaller devices, but rather adapt its content to fit any device:
</div>     
## INTRODUCTION

SPHP framework is an open source framework for developing interactive and responsive web applications
and services in object oriented PHP.
        
##Somethings under the hood
MD
);
printPage('tech-carousel');
md(<<<MD
## SYSTEM REQUIREMENTS and installation

Framework requires **PHP 7.0** or later; it is recommended to use the latest stable PHP version whenever possible.

Download the framework package from [github](https://github.com/samhol/SPHP-framework) and Install dependencies with Composer:

* [Composer installation](https://getcomposer.org/download/){target="_blank"}
* [Composer Documentation](https://getcomposer.org/doc/){target="_blank"}

## Disclaimer

It should go without saying, but any example code shown on this site is yours to use without obligation or warranty of any kind.
**However** this Site contains references to third party trademarks and names. Such trademarks and names are the sole property of their respective owners.
MD
);

///printPage('Sphp-intro/orbit.php');
