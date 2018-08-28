<?php

namespace Sphp\Html\Foundation\Navigation\SubNav;

$root = "http://apigen.samiholck.com";
$subNav = (new SubNav("ApiGen:"))
		->append(new Link("$root/namespace-Sphp.html", "Sphp", "apigen"))
		->appendLink("$root/namespace-Sphp.Html.html", "Html", "apigen")
		->appendLink("$root/namespace-Sphp.Html.Foundation.html", "Foundation", "apigen");
$subNav[] = new Link("$root/namespace-Sphp.Html.Foundation.Navigation.html", "Navigation", "apigen");
$subNav[] = new Link("$root/class-Sphp.Html.Foundation.Navigation.SubNav.html", "SubNav", "apigen");
$subNav->printHtml();
