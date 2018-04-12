<?php

namespace Sphp\Html\Head;

use Sphp\Html\Apps\Syntaxhighlighting\SyntaxHighlighter;
use Gajus\Dindent\Indenter;
use Sphp\Stdlib\Parser;

$namedContent = [
    'viewport' => 'width=device-width, initial-scale=1',
    'description' => '',
    'author' => 'faa',
    'keywords' => '',
    'robots' => 'index, follow',
    'mobile-web-app-capable' => 'yes',
    'author' => 'daa',
    'apple-mobile-web-app-capable' => 'yes',
];
$headCont = new HeadContentContainer();
$headCont->set(new Title('foo'));

$headCont->setLink(Link::shortcutIcon('foobar'));
foreach ($namedContent as $name => $value) {
  $headCont->setMeta(Meta::namedContent($name, $value));
}
$headCont->setLink(Link::shortcutIcon('foo'));
$headCont->set(new Title('foobar'));
$in = new Indenter();
//echo (new SyntaxHighlighter())->setSource($in->indent("$headCont"), 'html5');
//echo (new SyntaxHighlighter())->loadFromFile('Sphp/Html/Head/meta.yaml');
include'Sphp/Html/Head/meta-array.php';
echo "<pre>";
print_r(Parser::fromFile('Sphp/Html/Head/meta.yaml'));

use Sphp\Html\Head\HeadFactory;

$head = HeadFactory::fromArray(Parser::fromFile('Sphp/Html/Head/meta.yaml'));
echo (new SyntaxHighlighter())->setSource($in->indent("$head"), 'html5');
echo "</pre>";


