<?php

namespace Sphp\Core;

$httpRoot = Router::get()->http();
//$f5Root = $httpRoot . "/F5/";
$sidenavLinks["root"] = ["href" => $httpRoot, "text" => "Getting Started", "target" => "_self"];
$sidenavLinks["core"] = ["group" => "Core components", "sub" =>
    [
        ["href" => "$httpRoot?page=Sphp.Core", "text" => "Core components", "target" => "_self"],
        ["href" => "$httpRoot?page=Sphp.Core.Observers.and.Events", "text" => "Events and Observers"],
        ["href" => "$httpRoot?page=Sphp.Core.Types", "text" => "Core types and utlilities"],
        ["href" => "$httpRoot?page=Sphp.Core.Filters", "text" => "Data filtering"],
        ["href" => "$httpRoot?page=Sphp.Core.Gettext", "text" => "Native Language Support"],
        ["href" => "$httpRoot?page=Sphp.Net", "text" => "Network applications"]
    ]
];
$sidenavLinks["html_basics"] = ["group" => "HTML Basics", "sub" =>
    [
        ["href" => "$httpRoot?page=Sphp.Html", "text" => "Introduction"],
        ["href" => "$httpRoot?page=Sphp.Html.Document", "text" => "Document factory"],
        ["href" => "$httpRoot?page=Sphp.Html.Attributes", "text" => "Attribute management"],
        ["href" => "$httpRoot?page=Sphp.Html.Head", "text" => "Meta data manipulation"],
        ["href" => "$httpRoot?page=Sphp.Html.Media", "text" => "Images, audio and video"],
        ["href" => "$httpRoot?page=Sphp.Html.Programming", "text" => "Scripting and external applications"],
        ["href" => "$httpRoot?page=Sphp.Html.Lists..Tables", "text" => "Lists and Tables"],
        ["href" => "$httpRoot?page=Sphp.Html.Forms", "text" => "Forms"]
    ]
];
$sidenavLinks["foundation6"] = ["group" => "Foundation 6", "sub" =>
    [
        ["href" => "$httpRoot?page=Sphp.Html.Foundation.F6", "text" => "Introduction"],
        ["href" => "$httpRoot?page=Sphp.Html.Foundation.F6.Core", "text" => "Core"],
        ["href" => "$httpRoot?page=Sphp.Html.Foundation.F6.Grids", "text" => "Grids"],
        ["href" => "$httpRoot?page=Sphp.Html.Foundation.F6.Containers", "text" => "Containers"],
        ["href" => "$httpRoot?page=Sphp.Html.Foundation.F6.Navigation", "text" => "Navigation components"],
        ["href" => "$httpRoot?page=Sphp.Html.Foundation.F6.Buttons", "text" => "Buttons"],
        ["href" => "$httpRoot?page=Sphp.Html.Foundation.F6.Media", "text" => "Media components"],
        ["href" => "$httpRoot?page=Sphp.Html.Foundation.F6.Forms", "text" => "Form components"],
    //["href" => "$httpRoot?page=Sphp.Html.Foundation", "text" => "Miscellaneous components"]
    ]
];
$sidenavLinks["data_manipulation"] = ["group" => "Data manipulation", "sub" =>
    [
        ["href" => "$httpRoot?page=Sphp.Data", "text" => "Data Structures"],
        //["href" => "$httpRoot?page=Sphp.Util.datamanipulation", "text" => "Data manipulation"],
        ["href" => "$httpRoot?page=Sphp.Db.Objects", "text" => "Database objects"],
        //["href" => "$httpRoot?page=Sphp.Db", "text" => "Database manipulation"],
        ["href" => "$httpRoot?page=Sphp.Validation", "text" => "Data validation"]
    ]
];
/* $sidenavLinks["other"] = ["group" => "Other features", "sub" =>
  [
  ["href" => "$httpRoot?page=Sphp.Util.System", "text" => "System tools"],
  ["href" => "$httpRoot?page=Sphp.Util.Observers.and.Events", "text" => "Events and Observers"],
  ["href" => "$httpRoot?page=Sphp.Gettext", "text" => "Human language translation"],
  ["href" => "$httpRoot?page=Sphp.Net", "text" => "Network applications"]
  ]
  ]; */


Configuration::current()->set("SIDENAV_LINKS", $sidenavLinks);
$manualLinks = [
    $sidenavLinks["root"],
    $sidenavLinks["core"],
    ["separator" => "HTML manipulation:"],
    $sidenavLinks["html_basics"],
    $sidenavLinks["foundation6"],
    ["separator" => "Other features:"],
    $sidenavLinks["data_manipulation"]
];
//$manualLinks = array_merge($manualLinks, $sidenavLinks["other"]["sub"]);
Configuration::current()->set("MANUAL_LINKS", $manualLinks);

$pageTitles[] = $sidenavLinks["root"];
$pageTitles = array_merge($pageTitles, $sidenavLinks["core"]["sub"], $sidenavLinks["html_basics"]["sub"], $sidenavLinks["foundation6"]["sub"], $sidenavLinks["data_manipulation"]["sub"]
);

Configuration::current()->set("PAGE_TITLES", $pageTitles);
