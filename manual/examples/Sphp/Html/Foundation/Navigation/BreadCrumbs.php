<?php

namespace Sphp\Html\Foundation\Navigation;
$root = "http://apigen.samiholck.com";
$bc = new BreadCrumbs();
$bc[] = new BreadCrumb("$root/namespace-Sphp.html", "Sphp", "test");
$bc[] = new BreadCrumb("$root/namespace-Sphp.Html.html", "Html", "test");
$bc[] = new BreadCrumb("$root/namespace-Sphp.Html.Foundation.html", "Foundation", "test");
$bc->append(new BreadCrumb("$root/namespace-Sphp.Html.Foundation.Navigation.html", "Navigation", "test"));
$bc->prepend(new BreadCrumb($root, "ApiGen", "test"));
$bc->appendNew("$root/class-Sphp.Html.Foundation.Navigation.BreadCrumbs.html", "BreadCrumbs", "test");
$bc->printHtml();
?>