<?php
require_once __DIR__ . '/vendor/autoload.php';

include_once __DIR__ . '/sphp/jsConstants.php';
include_once __DIR__ . '/sphp/settings.php';

use Sphp\Html\Programming\Scripts as Scripts;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
  <body><pre>
      <?php
   //   echo $_SERVER['DOCUMENT_ROOT'];
      $a = new \Sphp\Html\Hyperlink("sphp/js/app/PhotoAlbum.js", "JS file");
      $a0 = new \Sphp\Html\Hyperlink("min/index.php?f=//sphp/js/app/PhotoAlbum.js", "JS file");
      $a1 = new \Sphp\Html\Hyperlink("min/?b=sphp/js/app&f=PhotoAlbum.js,commonJqueryPlugins.js,sphp.SideNavs.js", "JS file");
      //$s0 = (new \Sphp\Html\Programming\Script())->setSrc("http://localhost/PhpProject1/min/index.php", "JS file");
     //echo "$a $a0 $a1 \n" . decbin(PHP_INT_MAX);
     // $scripts = new Scripts();
    //  $scripts->fastclick()->modernizr()->jquery();
     // echo $scripts;
     // echo Sphp\Html\Programming\Script::minify(["sphp/js/vendor/foundation.all.min.js", "sphp/js/vendor/jquery.min.js"]);
    //  $scripts = new Scripts(Scripts::FOUNDATION);
  //    echo $scripts;
     // var_dump(file_exists("sphp/js/vendor/foundation.all.min.js"));

      use Sphp\System\Config as Config;

var_dump(Config::getDomains());
      $jsPaths = Config::obtain("Sphp\Js");
      $m = new \Sphp\Html\Programming\SphpMinifier();

      $m->enableSPHP();
      $a = new \Sphp\Html\Hyperlink("javaScripts.php", "JS file");
    //  echo $jsPaths;
      echo "$a\n";
      //echo Sphp\Html\Programming\Script::minify(["sphp/js/foundation.all.js" , "sphp/js/jquery.min.js", "blaa"]);
      //echo $m;
    //  print_r($_SERVER);
      ?></pre>
  </body>
</html>
