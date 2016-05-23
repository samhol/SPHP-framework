<?php

namespace Sphp\Html\Programming;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/min/vendor/autoload.php';

include_once __DIR__ . '/sphp/jsConstants.php';
include_once __DIR__ . '/sphp/settings.php';
\Sphp\Net\Headers::setContentType("text/javascript");
session_start();
echo "/*";
print_r($_SESSION);

$q = new \Sphp\Data\StablePriorityQueue();
$q->insert("a", 1);
$q->insert("b", 1);
$q->insert("c", 2);
var_dump($q);
$sq = serialize($q);
echo $sq;
$usq = unserialize($sq);
var_dump($usq);

echo "*/";

//$m = new SphpMinifier();
//$m->enableSPHP();
//$m->appendSrc("sphp/js/vendor/jquery.min.js");
//echo $m;

$cache = new \Minify_Cache_File();
$minify = new \Minify($cache);
$env = new \Minify_Env();
$sourceFactory = new \Minify_Source_Factory($env, [], $cache);
$controller = new \Minify_Controller_Files($env, $sourceFactory);

function src1_fetch() {
  $output = "";
  // if ($this->hasScripts()) {
  foreach ($_SESSION["script_files"] as $file) {
    $output.=\Sphp\Util\FileUtils::executePhpToString($file);
  }
//  }
  return $output;
}

// setup sources
$sources = [];
$sources[] = new \Minify_Source([
    'id' => 'source1',
    'getContentFunc' => 'src1_fetch',
    'contentType' => \Minify::TYPE_JS,
    'lastModified' => ($_SERVER['REQUEST_TIME'] - $_SERVER['REQUEST_TIME'] % 100),
        ]);

// setup serve and controller options
$options = [
    'files' => $sources,
    'maxAge' => 86400,
];
echo src1_fetch();
// handle request
//$minify->serve($controller, $options);
//print_r($_SERVER);
?>
