<?php

namespace Sphp\Html;

use Sphp\Core\Path;
use Sphp\Html\Sections\Paragraph;

$file = Path::get()->local("manual/snippets/loremipsum.html");
$container = new Container();
$container["heading"] = (new Headings\H5("Lorem ipsum dolor sit amet"))->addCssClass("sub-heading");
$container["paragraph"] = (new Paragraph())
		->appendRawFile($file)
		->setStyle("text-align", "justify");
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
$container[] = new Paragraph("<b>Components with title:</b> "
		. count($container->getComponentsByAttrName("title")));
$container->printHtml();
?>
