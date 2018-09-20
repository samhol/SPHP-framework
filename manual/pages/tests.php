<?php

use Sphp\Stdlib\Parsers\Parser;

echo "<pre>";
$f = Parser::yaml()->arrayFromFile("manual/examples/Sphp/Html/Head/meta.yaml");

foreach ($f as $v) {
  echo "\$head[] = " . rest($v) . "\n";
}

function rest(array $arr) {
  $type = key($arr);
  $output = '';
  if (is_scalar($arr[$type])) {
    $output .= '["' . ($k = key($arr)) . '" => "' . $arr[$type] . '"];';
  } else {
    $output .= '["' . ($k = key($arr)) . '" => ["' . \Sphp\Stdlib\Arrays::implodeWithKeys($arr[$k], '", "', '" => "') . '"]];';
  }
  return $output;
}



echo "</pre>";

$head[] = ["meta" => ["charset" => "utf-8"]];
$head[] = ["meta" => ["http-equiv" => "X-UA-Compatible", "content" => "IE=edge"]];
$head[] = ["meta" => ["name" => "viewport", "content" => "width=device-width, initial-scale=1"]];
$head[] = ["title" => "SPHPlayground Framework"];
$head[] = ["meta" => ["name" => "description", "content" => "SPHPlayground web framework"]];
$head[] = ["meta" => ["name" => "author", "content" => "Sami Holck"]];
$head[] = ["meta" => ["name" => "keywords", "content" => "php, scss, css, css3, html, html5, JavaScript, js"]];
$head[] = ["meta" => ["name" => "robots", "content" => "index, follow"]];
$head[] = ["meta" => ["name" => "mobile-web-app-capable", "content" => "yes"]];
$head[] = ["meta" => ["name" => "apple-mobile-web-app-capable", "content" => "yes"]];
$head[] = ["meta" => ["http-equiv" => "Expires", "content" => "0"]];
$head[] = ["meta" => ["http-equiv" => "Pragma", "content" => "no-cache"]];
$head[] = ["meta" => ["http-equiv" => "Cache-Control", "content" => "no-cache"]];
$head[] = ["meta" => ["http-equiv" => "imagetoolbar", "content" => "no"]];
$head[] = ["meta" => ["http-equiv" => "x-dns-prefetch-control", "content" => "off"]];
$head[] = ["meta" => ["http-equiv" => "apple-mobile-web-app-capable", "content" => "yes"]];
$head[] = ["link" => ["rel" => "apple-touch-icon", "sizes" => "180x180", "href" => "/apple-touch-icon.png"]];
$head[] = ["link" => ["rel" => "icon", "type" => "image/png", "sizes" => "32x32", "href" => "/favicon-32x32.png"]];
$head[] = ["link" => ["rel" => "icon", "type" => "image/png", "sizes" => "16x16", "href" => "/favicon-16x16.png"]];
$head[] = ["link" => ["rel" => "manifest", "href" => "/site.webmanifest"]];
$head[] = ["link" => ["rel" => "mask-icon", "href" => "/safari-pinned-tab.svg", "color" => "#555555"]];
$head[] = ["meta" => ["name" => "msapplication-TileColor", "content" => "#edd4cd"]];
$head[] = ["meta" => ["name" => "msapplication-TileImage", "content" => "/mstile-144x144.png"]];
$head[] = ["meta" => ["name" => "theme-color", "content" => "#ffffff"]];
 
Sphp\Manual\visualize('Sphp/Html/Head/Link.php', 'html5', false);
