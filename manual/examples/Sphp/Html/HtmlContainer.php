<?php

namespace Sphp\Html;

use Sphp\Html\Flow\Paragraph;
use Sphp\Html\Flow\Headings\H5;

$container = new Container();
$container["heading"] = (new H5("Lorem ipsum dolor sit amet"))->addCssClass("sub-heading");
$container["paragraph"] = (new Paragraph())
        ->appendRawFile("manual/snippets/loremipsum.html");
$container["paragraph"]->inlineStyles()->setProperty("text-align", "justify");
$container->append(new \stdClass());

/**
 * A lambda function for object searching
 *
 * @param mixed $element
 */
$search = function($element) {
  return (is_object($element));
};
//
$container[] = new Paragraph("<b><var>objects</var>(s):</b> "
        . count($container->getComponentsBy($search)));
$container->printHtml();
