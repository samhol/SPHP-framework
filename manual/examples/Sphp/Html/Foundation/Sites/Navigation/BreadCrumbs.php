<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

$root = "http://playground.samiholck.com";
$bc = (new BreadCrumbs())
        ->append(new BreadCrumb("$root/?page=Sphp.Html.Foundation.Sites.Navigation", "F6 navigation"))
        ->append((new BreadCrumb("$root/namespace-Sphp.Html.html", "Html", "test"))->setDisabled())
        ->append(new BreadCrumb("$root/namespace-Sphp.Html.Foundation.html", "Foundation", "test"));
$bc->append(new BreadCrumb("$root/namespace-Sphp.Html.Foundation.Navigation.html", "Navigation", "test"));
$bc->prepend(new BreadCrumb($root, "ApiGen", "test"));
$bc->appendLink("$root/class-Sphp.Html.Foundation.Navigation.BreadCrumbs.html", "BreadCrumbs", "test");
$bc->printHtml();
