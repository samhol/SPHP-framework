<?php

namespace Sphp\Html;

use Sphp\Html\Apps\SyntaxHighlightingAccordion as SyntaxHighlighter;
use Sphp\Html\Foundation\F6\Navigation\TopBar\TopBar as TopBar;
use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;
use Sphp\Core\Types\Strings as Strings;
use Sphp\Html\Foundation\F6\Containers\Tabs\Tabs as Tabs;

$clienTabs = (new Tabs())->matchHeight(true);
$clienTabs->addTab("HTML", Strings::parseMarkdown(<<<EOD
HyperText Markup Language, commonly referred to as <b>HTML</b>, is the standard markup 
language used to create web pages. It is a cornerstone technology used to create 
web pages, as well as to create user interfaces for mobile and web applications.
EOD
))
->addTab("CSS", Strings::parseMarkdown(<<<EOD
Cascading Style Sheets (CSS) is a style sheet language used for describing the 
presentation of a document written in a markup language.CSS is designed primarily 
to enable the separation of document content from document presentation, including 
aspects such as the layout, colors, and fonts.
EOD
))
->addTab("SCSS", Strings::parseMarkdown(<<<EOD
**Sass** is a scripting language that is interpreted into **Cascading Style 
Sheets (CSS)**. Sass consists of two syntaxes. The original syntax uses indentation to separate code blocks and 
newline characters to separate rules. The newer syntax, <b>SCSS</b>, uses block 
formatting like that of **CSS**. It uses braces to denote code blocks and semicolons 
to separate lines within a block. The indented syntax and **SCSS** files are 
traditionally given the extensions .sass and .scss, respectively.
EOD
))
->addTab("JavaScript", Strings::parseMarkdown(<<<EOD
**JavaScript** is a high-level, dynamic, untyped, and interpreted programming language. 
It has been standardized in the **ECMAScript** language specification. the majority of 
websites employ it and it is supported by all modern Web browsers without plug-ins.
**JavaScript** is *prototype*-based with *first-class functions*, making it a *multi-paradigm* 
  language, supporting *object-oriented*, *imperative*, and *functional* programming styles.
EOD
));
echo $parsedown->text(<<<EOD
#Introduction

SPHP framework is an open source framework for developing interactive web applications
and services in object oriented PHP. It supports many aspects of full stack Web 
application developement. Framework has all the web programming goodies (`PHP`-, `SQL`-, `CSS`-, `SCSS`- and `JavaScript`) under its hood, 
but generally deploying framework requires no usage of other programming languages than PHP.

The HTML namespace contains mobile friendly customizable UI 
components compatibile with most web browsers and devices. Most UI components are 
based on Foundation frontend framework. 
  
EOD
);
//$clienTabs->printHtml();

echo $parsedown->text(<<<EOD
	
The `SPHP` abreviation is a combination of my name `S`ami `P`etteri `H`olck and `P`HP: hypertext preprosessor.

##What Comes With SPHP Framework?
<div class="row intro" data-equalizer data-equalize-on="medium">
<div class="column small-12 medium-6">  
<div class="callout" markdown="1" data-equalizer-watch>
External server side libraries:
 :[Doctrine](http://www.doctrine-project.org/) — <i class="tech label php"></i>
 :[GeSHi](http://qbnz.com/highlighter/){target="_blank"} — <i class="tech label php"></i>
 :[Imagine](https://imagine.readthedocs.org/){target="_blank"} — <i class="tech label php"></i>
 :[Parsedown Extra](https://github.com/erusev/parsedown-extra){target="_blank"} — <i class="tech label php"></i>
</div>
</div>
<div class="column small-12 medium-6" markdown="1"> 
<div class="callout" markdown="1" data-equalizer-watch>
External client side libraries:
 :[jQuery](http://jQuery.com){target="_blank"} <i class="tech label js"></i>
 :[Foundation](http://foundation.zurb.com/){target="_blank"} <i class="tech label html5"></i><i class="tech label css3"></i><i class="tech label js"></i>
 :[Lazy Load XT](http://ressio.github.io/lazy-load-xt/){target="_blank"} <i class="tech label js"></i>
 :[ZeroClipboard](http://zeroclipboard.org/){target="_blank"} <i class="tech label js"></i><i class="tech label flash"></i> 
 :[Ion.RangeSlider](https://github.com/IonDen/ion.rangeSlider){target="_blank"} <i class="tech label js"></i><i class="tech label css3"></i>
 :[qTip<sup>2</sup>](http://qtip2.com/){target="_blank"} <i class="tech label js"></i> <i class="tech label css3"></i>
 :[Any+Time™](http://www.ama3.com/anytime/){target="_blank"} <i class="tech label js"></i><i class="tech label css3"></i>
</div>
</div>
</div>
EOD
);
$load("Sphp.Html.Foundation-orbit-intro.php");

echo $parsedown->text(<<<MD
###SYSTEM REQUIREMENTS

Framework requires PHP 5.5 or later; it is recommended to use the latest stable PHP version whenever possible.

Download the framework package from [github](https://github.com/samhol/SPHP) and Install it with Composer:
        
* [Composer installation](https://getcomposer.org/download/){target="_blank"}
* [Composer Documentation](https://getcomposer.org/doc/){target="_blank"}



MD
);


