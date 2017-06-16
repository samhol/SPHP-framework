<?php

namespace Sphp\Html\Tables;

$p[] = ['Basic',
    [
        ['html', 'An html document'],
        ['body', 'The body element'],
        ['p', 'A paragraph'],
        ['hr', 'A horizontal rule'],
        ['br', ' Inserts a single line break']
    ]
];
$p[] = ['Headings',
    [
        ['h1', '1st. level header'],
        ['h2', '2nd. level header'],
        ['h3', '3rd. level header'],
        ['h4', '4th. level header'],
        ['h5', '5th. level header'],
        ['h6', '6th. level header']
    ]
];

$p[] = ['Formatting',
    [
        ['abbr', 'An abbreviation'],
        ['address', 'An address element'],
        ['b', 'Bold text'],
        ['bdi', 'Isolates a part of text that might be formatted in a different direction from other text outside it'],
        ['bdo', 'The direction of text display'],
        ['blockquote', 'A section that is quoted from another source'],
        ['cite', 'A citation'],
        ['code', 'Computer code text'],
        ['del', 'Deleted text'],
        ['dfn', 'A definition term'],
        ['em', 'Defines emphasized text'],
        ['i', 'Italic text'],
        ['ins', 'Inserted text'],
        ['kbd', 'Defines keyboard text'],
        ['mark', 'Defines marked text'],
        ['meter', 'Defines measurement within a predefined range'],
        ['pre', 'Defines preformatted text'],
        ['progress', 'Defines progress of a task of any kind'],
        ['q', 'A short quotation'],
        ['rp', 'Used in ruby annotations to define what to show browsers that to not support the ruby element.'],
        ['rt', 'Defines explanation to ruby annotations.'],
        ['ruby', 'Defines ruby annotations.'],
        ['s', 'Text that is no longer correct'],
        ['samp', 'Defines sample computer code'],
        ['small', 'Defines small text'],
        ['strong', 'Defines strong text'],
        ['sub', 'Defines subscripted text'],
        ['sup', 'Defines superscripted text'],
        ['time', 'A date/time'],
        ['u', 'Text that should be stylistically different from normal text'],
        ['var', 'A variable'],
        ['wbr', 'A possible line-break']
    ]
];

$p[] = ['Forms',
    [
        ['form', 'A form'],
        ['input:hidden', 'A hidden input field'],
        ['input:text', 'A text input field'],
        ['input:email', 'An email input field'],
        ['input:number', 'A number input field'],
        ['input:password', 'A password input field'],
        ['input:radio', 'A radio input'],
        ['input:checkbox', 'A checkbox input'],
        ['textarea', 'A text area'],
        ['button:button', 'A push button'],
        ['button:reset', 'A reset button for forms'],
        ['button:submit', 'A sybmit button for forms'],
        ['keygen', 'A generated key in a form'],
        ['output', 'Defines some types of output'],
        ['label', 'A label for a form control'],
        ['fieldset', 'A fieldset'],
        ['legend', 'A title in a fieldset'],
        ['datalist', 'A dropdown list'],
        ['select', 'A selectable list'],
        ['optgroup', 'An option group'],
        ['option', 'An option in a drop-down list']
    ]
];

namespace Sphp\Html\Media;

$av = $api->classLinker(Multimedia\Audio::class) . ' and ' . $api->classLinker(Multimedia\Video::class);
$p[] = ['Media', [
        ['img', 'An image'],
        ['area', 'An area inside an image map'],
        ['map', 'An image map'],
        ['canvas', 'Graphics canvas'],
        ['figure', 'A group of media content, and their caption'],
        ['figcaption', "A caption for a {$api->classLinker(Figure::class)} component"],
        ['audio', 'Sound content'],
        ['video', 'Video content'],
        ['track', "Text tracks for $av components"],
        ['source', "Multiple media resources for $av components"],
        ['embed', 'External interactive content or plugin'],
        ['iframe', 'An inline sub window (frame)']
    ]
];


$p[] = ['Links', [
        ['a', 'A hyperlink'],
        ['nav', 'Defines navigation links']
    ]
];

namespace Sphp\Html\Lists;

$dl = 'for ' . $api->classLinker(Dl::class) . ' component';
$p['Lists'] = ['Lists',
    [
        ['ul', 'An unordered list'],
        ['ol', 'An ordered list'],
        ['li', "A list item for " . $api->classLinker(Ul::class) . " and " . $api->classLinker(Ol::class) . " components"],
        ['dl', 'A definition list'],
        ['dd', "A definition description $dl"],
        ['dt', "A definition term $dl"],
        ['menu', 'A menu list']
    ]
];

$p[] = ['Tables',
    [
        ['table', 'A table'],
        ['caption', 'A table caption'],
        ['th', 'A table header'],
        ['td', 'A table cell'],
        ['tr', 'A table row'],
        ['thead', 'A table header'],
        ['tbody', 'A table body'],
        ['tfoot', 'A table footer'],
        ['col', 'Attributes for table columns'],
        ['colgroup', 'Groups of table columns']
    ]
];

$p[] = ['Style/Sections',
    [
        ['style', 'A style definition'],
        ['div', 'A section in a document'],
        ['span', 'A section in a document'],
        ['header', 'A header for a section or page'],
        ['footer', 'A footer for a section or page'],
        ['article', 'An article'],
        ['aside', 'Content aside from the page content'],
        ['details', 'Details of an element'],
        ['dialog', 'A dialog (conversation)'],
        ['section', 'A section']
    ]
];

$p[] = ['Head',
    [
        ['head', 'Information about the document'],
        ['title', 'Document title'],
        ['link', 'A resource reference'],
        ['meta', 'Meta information'],
        ['base', 'A base URL for all the links in a page']
    ]
];

$p[] = ["Programming",
    [
        ['script:code', 'Contains scripting statements'],
        ['script:src', 'Points to an external script file'],
        ['noscript', 'A noscript section'],
        ['object', 'An embedded object'],
        ['param', 'A parameter for an object']
    ]
];

namespace Sphp\Html\Tables;

use Sphp\Html\Document;
use Sphp\Html\Adapters\QtipAdapter;
$generateTagTable = function(array $v) use ($api, $w3schools) {
  $table = (new Table())
          ->addCssClass('html-to-php');
  $table->thead()
          ->appendHeaderRow(['Parameter', 'HTML Tag', 'PHP type', 'Description']);
  $body = $table->tbody();
  foreach ($v as $data) {
    if (is_string($data)) {
      $body[] = new Th($data, 'colgroup', 4, 1);
    } else {
      $c = array();
      $tag = Document::get($data[0]);
      $ref = new \ReflectionClass($tag);
      //$linkText = htmlspecialchars("$tag");
      $linkText = "&lt;" . $tag->getTagName();
      if ($tag->attrExists("type")) {
        $linkText .= ' type="' . $tag->getAttr("type") . '"';
      }
      $linkText .= "&gt;";
      $param = new \Sphp\Html\Span("$data[0]");
      $tooptipText = "Document::get(\"$data[0]\")";
      $c[] = new QtipAdapter($param, $tooptipText);
      $c[] = $w3schools->tag($tag->getTagName(), $linkText);
      $text = $ref->getNamespaceName() . "\\<b>" . $ref->getShortName() . "</b>";
      $c[] = $api->classLinker($ref->getName(), $text)->getLink();
      $c[] = $data[1];
      $body->appendBodyRow($c);
    }
  }
  return "$table";
};

use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;

//use Sphp\Html\Programming\Script as Script;
$accordions = (new Accordion())
        ->allowAllClosed(true)
        ->allowMultiExpand(true)
        ->addCssClass("html-ref-tables");
foreach ($p as $val) {
  $accordions->append(new Pane($val[0], $generateTagTable($val[1])));
  // $accordion = new SingleAccordion($val[0], $generateTagTable($val[1]));
  // $accordion->body()->addCssClass("sphp-padding-1");
  // $accordion->printHtml();
}
$accordions->printHtml();
