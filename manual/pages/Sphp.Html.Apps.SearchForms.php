<?php

namespace Sphp\Html\Apps\Forms;

use Sphp\Manual;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$freefind  = Manual\api()->classLinker(FreefindSearchForm::class);
$siteSearch360Form  = Manual\api()->classLinker(SiteSearch360Form::class);

\Sphp\Manual\md(<<<MD
##Search forms
$ns
###$freefind
Since 1998 FreeFind has provided site search engines to over 200,000 websites. 
Advanced site search can be added to your website in minutes. With nothing to 
download or install it's easy and it's free!

###$siteSearch360Form     
Site Search 360 is a fast, comprehensive, and yet super easy to install search 
solution for your website
MD
);

Manual\visualize('Sphp/Html/Apps/Forms/SearchForms.php');
