<?php

namespace Sphp\Html;

use Sphp\Core\Util\LocalFile;

$fileLoader = new LocalFile(\Sphp\Manual\LOREM_IPSUM_PATH);
$container = new PlainContainer();
$container["heading"] = (new headings\H5("Lorem ipsum dolor sit amet"))->addCssClass("sub-heading");
$container["heading"]->setTitle("Lorem ipsum!");
$container["paragraph"] = (new Paragraph())
		->ajaxPrepend("http:/sphp.samiholck.com/sphpManual/examples/loremipsum.html");

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
