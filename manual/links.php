<?php

namespace Sphp\Core;

$httpRoot = Path::get()->http();

$sidenavLinks['root'] = ['href' => $httpRoot, 'text' => 'Getting Started', 'target' => '_self'];
$sidenavLinks['core'] = ['group' => 'Core components', 'sub' =>
    [
        ['href' => "$httpRoot?page=Sphp.Core", 'text' => 'Core components', 'target' => "_self"],
        ['href' => "$httpRoot?page=Sphp.Core.Observers.and.Events", 'text' => 'Events and Observers'],
        ['href' => "$httpRoot?page=Sphp.Core.Types", 'text' => 'Core types and utlilities'],
        ['href' => "$httpRoot?page=Sphp.Core.Filters", 'text' => 'Data filtering'],
        ['href' => "$httpRoot?page=Sphp.Core.I18n", 'text' => 'Native Language Support'],
        ['href' => "$httpRoot?page=Sphp.Net", 'text' => 'Network applications']
    ]
];
$sidenavLinks['html_basics'] = ["group" => "HTML Basics", 'sub' =>
    [
        ['href' => "$httpRoot?page=Sphp.Html", 'text' => 'Introduction'],
        ['href' => "$httpRoot?page=Sphp.Html.Document", 'text' => 'Document factory'],
        ['href' => "$httpRoot?page=Sphp.Html.Attributes", 'text' => 'Attribute management'],
        ['href' => "$httpRoot?page=Sphp.Html.Head", 'text' => 'Meta data manipulation'],
        ['href' => "$httpRoot?page=Sphp.Html.Media", 'text' => 'Images, audio and video'],
        ['href' => "$httpRoot?page=Sphp.Html.Programming", 'text' => 'Scripting and external applications'],
        ['href' => "$httpRoot?page=Sphp.Html.Lists..Tables", 'text' => 'Lists and Tables'],
        ['href' => "$httpRoot?page=Sphp.Html.Forms", 'text' => 'Forms']
    ]
];
$sidenavLinks['foundation6'] = ['group' => 'Foundation Sites', 'sub' =>
    [
        ['href' => "$httpRoot?page=Sphp.Html.Foundation.Sites", 'text' => 'Introduction'],
        ['href' => "$httpRoot?page=Sphp.Html.Foundation.Sites.Core", 'text' => 'Core'],
        ['href' => "$httpRoot?page=Sphp.Html.Foundation.Sites.Grids", 'text' => 'Grids'],
        ['href' => "$httpRoot?page=Sphp.Html.Foundation.Sites.Containers", 'text' => 'Containers'],
        ['href' => "$httpRoot?page=Sphp.Html.Foundation.Sites.Navigation", 'text' => 'Navigation components'],
        ['href' => "$httpRoot?page=Sphp.Html.Foundation.Sites.Buttons", 'text' => 'Buttons'],
        ['href' => "$httpRoot?page=Sphp.Html.Foundation.Sites.Media", 'text' => 'Media components'],
        ['href' => "$httpRoot?page=Sphp.Html.Foundation.Sites.Forms", 'text' => 'Form components'],
    //['href' => "$httpRoot?page=Sphp.Html.Foundation", 'text' => "Miscellaneous components"]
    ]
];
$sidenavLinks["data_manipulation"] = ["group" => 'Data manipulation', 'sub' =>
    [
        ['href' => "$httpRoot?page=Sphp.Data", 'text' => 'Data Structures'],
        ['href' => "$httpRoot?page=Sphp.Db.Objects", 'text' => 'Database objects'],
        ['href' => "$httpRoot?page=Sphp.Validation", 'text' => 'Data validation']
    ]
];



Configuration::current()->set('SIDENAV_LINKS', $sidenavLinks);
$manualLinks = [
    $sidenavLinks['root'],
    $sidenavLinks['core'],
    ['separator' => 'HTML manipulation:'],
    $sidenavLinks['html_basics'],
    $sidenavLinks['foundation6'],
    ["separator" => 'Other features:'],
    $sidenavLinks['data_manipulation']
];

Configuration::current()->set('MANUAL_LINKS', $manualLinks);

$pageTitles[] = $sidenavLinks['root'];
$pageTitles = array_merge($pageTitles, $sidenavLinks['core']['sub'], $sidenavLinks['html_basics']['sub'], $sidenavLinks['foundation6']['sub'], $sidenavLinks['data_manipulation']["sub"]
);

Configuration::current()->set('PAGE_TITLES', $pageTitles);
