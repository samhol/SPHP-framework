<?php

namespace Sphp\I18n;

use Sphp\Html\Apps\Manual\Apis;

$php = Apis::phpManual();
$translatorInteface = \Sphp\Manual\api()->classLinker(TranslatorInterface::class);
$gettextTranslator  = \Sphp\Manual\api()->classLinker(Gettext\Translator::class);
$vsprintfLink = Apis::phpManual()->functionLink("vsprintf");

$gettextNs = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
##Human language translations: <small>Using The $translatorInteface</small>
   
The $translatorInteface is the base interface for all human language translation related 
operations in this framework.  I supports both basic and plural Gettext style translation. 
  
The translator itself is initialized without any parameters, as any configuration 
to it is optional. A translator without any translations will do nothing but return 
all messages verbatim.

A $translatorInteface object supports both basic and plural Gettext style translation. 
It has also a method similar to PHP's native $vsprintfLink 
function for both basic and plural translations. Additionally the class contain a 
method for translating a multidimensional array containing singular translatable message strings (plural form 
is not supported).
MD
);

\Sphp\Manual\loadPage('Sphp.I18n.Gettext');
\Sphp\Manual\loadPage('Sphp.I18n.Zend');
