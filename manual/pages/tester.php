<?php

namespace Sphp\Html\Head;

use Sphp\Html\Apps\Syntaxhighlighting\GeSHiSyntaxHighlighter;
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

$headCont->setLink(Link::icon('foobar'));
foreach ($namedContent as $name => $value) {
  $headCont->setMeta(Meta::namedContent($name, $value));
}
$headCont->setLink(Link::icon('foo'));
$headCont->set(new Title('foobar'));
$in = new Indenter();
//echo (new SyntaxHighlighter())->setSource($in->indent("$headCont"), 'html5');
//echo (new SyntaxHighlighter())->loadFromFile('Sphp/Html/Head/meta.yaml');
include'Sphp/Html/Head/meta-array.php';
echo "<pre>";
print_r(Parser::fromFile('Sphp/Html/Head/meta.yaml'));
//print_r($meta_data);
$y =new \Sphp\Stdlib\Parsers\Yaml;
echo $y->encodeArray($meta_data);
use Sphp\Html\Head\HeadFactory;

$head = HeadFactory::fromArray(Parser::fromFile('Sphp/Html/Head/meta.yaml'));
echo "</pre>";
echo (new GeSHiSyntaxHighlighter())->setSource($in->indent("$head"), 'html5');


