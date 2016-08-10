<?php

namespace Sphp\Html;

use Sphp\Core\Util\LocalFile as LocalFile;
use Sphp\Html\Sections\Paragraph as Paragraph;

$fileLoader = new LocalFile("manual/snippets/loremipsum.html");
$container = new Container();
$container["heading"] = (new Headings\H5("Lorem ipsum dolor sit amet"))->addCssClass("sub-heading");
$container["heading"]->setTitle("Lorem ipsum!");
$container["paragraph"] = (new Paragraph())
		->append($fileLoader->getTextFileRows())
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