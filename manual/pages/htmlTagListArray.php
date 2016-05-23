<?php

namespace Sphp\Html\Tables;

//array("!--...--", "Defines a comment");
//array("!DOCTYPE", "Defines the document type");
$p[] = ["Basic",
    [
        ["html", "Defines an html document"],
        ["body", "Defines the body element"],
        ["p", "Defines a paragraph"],
        ["hr", "Defines a horizontal rule"],
        ["br", " Inserts a single line break"]
    ]
];
$p[] = ["Headings",
    [
        ["h1", "Defines header 1"],
        ["h2", "Defines header 2"],
        ["h3", "Defines header 3"],
        ["h4", "Defines header 4"],
        ["h5", "Defines header 5"],
        ["h6", "Defines header 6"]
    ]
];

$p[] = ["Formatting",
    [
        ["abbr", "Defines an abbreviation"],
        ["address", "Defines an address element"],
        ["b", "Defines bold text"],
        ["bdi", "Isolates a part of text that might be formatted in a different direction from other text outside it"],
        ["bdo", "Defines the direction of text display"],
        ["blockquote", "Defines a section that is quoted from another source"],
        ["cite", "Defines a citation"],
        ["code", "Defines computer code text"],
        ["del", "Defines deleted text"],
        ["dfn", "Defines a definition term"],
        ["em", "Defines emphasized text"],
        ["i", "  Defines italic text"],
        ["ins", "Defines inserted text"],
        ["kbd", "Defines keyboard text"],
        ["mark", "Defines marked text"],
        ["meter", "Defines measurement within a predefined range"],
        ["pre", "Defines preformatted text"],
        ["progress", "Defines progress of a task of any kind"],
        ["q", "Defines a short quotation"],
        ["rp", "Used in ruby annotations to define what to show browsers that to not support the ruby element."],
        ["rt", "Defines explanation to ruby annotations."],
        ["ruby", "Defines ruby annotations."],
        ["s", "Defines text that is no longer correct"],
        ["samp", "Defines sample computer code"],
        ["small", "Defines small text"],
        ["strong", "Defines strong text"],
        ["sub", "Defines subscripted text"],
        ["sup", "Defines superscripted text"],
        ["time", "Defines a date/time"],
        ["u", "Defines text that should be stylistically different from normal text"],
        ["var", "Defines a variable"],
        ["wbr", "Defines a possible line-break"]
    ]
];

$p[] = ["Forms",
    [
        ["form", "Defines a form"],
        ["input:hidden", "Defines a hidden input field"],
        ["input:text", "Defines a text input field"],
        ["input:password", "Defines a password input field"],
        ["input:radio", "Defines a radio input"],
        ["input:checkbox", "Defines a checkbox input"],
        ["textarea", "Defines a text area"],
        ["button:button", "Defines a push button"],
        ["button:reset", "Defines a push button for form resetting"],
        ["button:submit", "Defines a push button for form submitting"],
        ["keygen", "Defines a generated key in a form"],
        ["output", "Defines some types of output"],
        ["label", "Defines a label for a form control"],
        ["fieldset", "Defines a fieldset"],
        ["legend", "Defines a title in a fieldset"],
        ["datalist", "Defines a dropdown list"],
        ["select", "Defines a selectable list"],
        ["optgroup", "Defines an option group"],
        ["option", "Defines an option in a drop-down list"]
    ]
];

namespace Sphp\Html\Media;

$av = $api->getClassLink(Audio::class) . " and " . $api->getClassLink(Video::class);
$p[] = ["Media", [
        ["img", "Defines an image"],
        ["area", "Defines an area inside an image map"],
        ["map", "Defines an image map"],
        ["canvas", "Defines graphics"],
        ["figure", "Defines a group of media content, and their caption"],
        ["figcaption", "Defines a caption for a {$api->getClassLink(Figure::class)} component"],
        ["audio", "Defines sound content"],
        ["video", "Defines a video"],
        ["track", "Defines text tracks for $av components"],
        ["source", "Defines multiple media resources for $av components"],
        ["embed", "Defines external interactive content or plugin"],
        ["iframe", "Defines an inline sub window (frame)"]
    ]
];


$p[] = ["Links", [
        ["a", "Defines a hyperlink"],
        ["nav", "Defines navigation links"]
    ]
];

namespace Sphp\Html\Lists;

$dl = "for " . $api->getClassLink(Dl::class) . " component";
$p["Lists"] = ["Lists",
    [
        ["ul", "Defines an unordered list"],
        ["ol", "Defines an ordered list"],
        ["li", "Defines a list item for " . $api->getClassLink(Ul::class) . " and " . $api->getClassLink(Ol::class) . " components"],
        ["dl", "Defines a definition list"],
        ["dd", "Defines a definition description $dl"],
        ["dt", "Defines a definition term $dl"],
        ["menu", "Defines a menu list"]
    ]
];

$p[] = ["Tables",
    [
        ["table", "Defines a table"],
        ["caption", "Defines a table caption"],
        ["th", "Defines a table header"],
        ["td", "Defines a table cell"],
        ["tr", "Defines a table row"],
        ["thead", "Defines a table header"],
        ["tbody", "Defines a table body"],
        ["tfoot", "Defines a table footer"],
        ["col", "Defines attributes for table columns"],
        ["colgroup", "Defines groups of table columns"]
    ]
];

$p[] = ["Style/Sections",
    [
        ["style", "Defines a style definition"],
        ["div", "Defines a section in a document"],
        ["span", "Defines a section in a document"],
        ["header", "Defines a header for a section or page"],
        ["footer", "Defines a footer for a section or page"],
        ["article", "Defines an article"],
        ["aside", "Defines content aside from the page content"],
        ["details", "Defines details of an element"],
        ["dialog", "Defines a dialog (conversation)"],
        ["section", "Defines a section"]
    ]
];

$p[] = ["Head",
    [
        ["head", "Defines information about the document"],
        ["title", "Defines the document title"],
        ["link", "Defines a resource reference"],
        ["meta", "Defines meta information"],
        ["base", "Defines a base URL for all the links in a page"]
    ]
];

$p[] = ["Programming",
    [
        ["script:code", "Contains scripting statements"],
        ["script:src", "Points to an external script file"],
        ["noscript", "Defines a noscript section"],
        ["object", "Defines an embedded object"],
        ["param", "Defines a parameter for an object"]
    ]
];

namespace Sphp\Html\Tables;

use Sphp\Html\Doc as Doc;
use Sphp\Util\Strings as Strings;

$generateTagTable = function(array $v) use ($api, $w3schools) {
  $table = (new Table())
          ->addCssClass("html-to-php");
  $table->thead()
          ->append(["Parameter", "HTML Tag", "PHP Object type", "Description"]);
  $body = $table->tbody();
  foreach ($v as $data) {
    if (is_string($data)) {
      $body[] = new Th($data, "colgroup", 4);
    } else {
      $c = array();
      $tag = Doc::get($data[0]);
      $ref = new \ReflectionClass($tag);
      //$linkText = htmlspecialchars("$tag");
      $linkText = "&lt;" . $tag->getTagName();
      if (Strings::contains("input:", $data[0]) || Strings::contains("button:", $data[0])) {
        $linkText .= ' type="' . $tag->getAttr("type") . '"';
      }
      $linkText .= "&gt;";
      $param = new \Sphp\Html\Span("$data[0]");
      $tooptipText = "call Doc::get(\"$data[0]\")";
      $c[] = new \Sphp\Html\Foundation\F6\Media\Tooltip($param, $tooptipText);
      $c[] = $w3schools->getTagLink($tag->getTagName(), $linkText)->addCssClass("scale-to-fit");
      $text = $ref->getNamespaceName() . "\\<b>" . $ref->getShortName() . "</b>";
      $c[] = $api->getClassLink($ref->getName(), $text)->addCssClass("scale-to-fit")->removeCssClass("bordered");
      $c[] = $data[1];
      $body[] = $c;
    }
  }
  return "$table";
};

use Sphp\Html\Foundation\F6\Containers\Accordions\Accordion as Accordions;
use Sphp\Html\Foundation\F6\Containers\Accordions\Pane as Accordion;

//use Sphp\Html\Programming\Script as Script;
//(new Script)->setSrc(\Sphp\HTTP_ROOT . "sphpManual/js/htmlToPHP.js")->printHtml();
$accordions = (new Accordions())
        ->allowAllClosed(true)
        ->allowMultiExpand(true)
        ->addCssClass("html-ref-tables");
foreach ($p as $val) {
  $accordions->append(new Accordion($val[0], $generateTagTable($val[1])));
  // $accordion = new SingleAccordion($val[0], $generateTagTable($val[1]));
  // $accordion->body()->addCssClass("sphp-padding-1");
  // $accordion->printHtml();
}
$accordions->printHtml();
?>