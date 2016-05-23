<?php

namespace Sphp\Html;

use Sphp\Html\Apps\SyntaxHighlightingAccordion as SyntaxHighlighter;
use Sphp\Html\Foundation\Navigation\TopBar as TopBar;
use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

echo $parsedown->text(<<<EOD
		
#Getting Started

Modern web application are build using multiple programming languages:
	
* **Front-end programming** (client side): `HTML`, `CSS` | `SCSS` and `JavaScript`
* **Back-end programming** (server side): `SQL` and `PHP`, `ASP`, `Java` or some other server side language
	
Developement and maintenance of these complex applications is both difficult and time consuming.
SPHP Framework is a humble attempt of  one man to simplify this developement process. The `SPHP` 
abreviation is a combination of my name `S`ami `P`etteri `H`olck and `P`HP: hypertext preprosessor.

##What is SPHP Framework actually?
		
SPHP framework is an open source framework for developing interactive web applications
and services in PHP language. It contains both responsive front-end components and components
for many common server side operations. The front-end part contains many build-in mobile friendly customizable UI 
components compatibile with most web browsers and devices. 
	
SPHP framework interconnects `PHP`-, `SQL`-, `CSS`-, `SCSS`- and `JavaScript` programming to more
meaningfull and maintainable PHP objects. These objects can be used within PHP code blocks 
and in many cases the web application developement requires no usage of other programming languages.
		
##Who uses SPHP Framework?

Framework is currently used only in this SPHP manual and in <http://www.samiholck.com/>
		
<p>Download links:</p>
{$gitDlLink->addCssClass("button tiny rounded sph-button")->getHtml()}

###Installation
Installation Sphp framework

1. Download the current release and store it on your hard disc
2.Extract this zip archive and copy the sph directory to your web server
3.Make the following files writable (chmod 0666):
EOD
);
