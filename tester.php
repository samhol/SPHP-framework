<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Core\Router;
use Sphp\Html\Document;

error_reporting(E_ALL);
ini_set("display_errors", 1);
//require_once __DIR__ . '/vendor/autoload.php';
include_once("manual/settings.php");
include_once("manual/links.php");
include_once(\Sphp\PDO_SESSIONING);
ob_implicit_flush(true);
include_once("manual/htmlHead.php");

Document::html("manual")->scripts()->appendSrc("manual/js/formTools.js");
?>
<body class="manual" id="manual-body">
  <div class="sphp-logo">
    <a href="<?php echo Router::get()->http() ?>" target="_self" title="Navigate back to frontpage" data-sphp-qtip>
      <img src="manual/pics/sphp-code-logo.png" alt="SPHP framework">
    </a>
    <?php

    use Sphp\Html\Foundation\Sites\Containers\Dropdown as Dropdown;
    use Sphp\Html\Foundation\Sites\Foundation as F;

$ul = (new \Sphp\Html\Lists\Ul())->addCssClass("social-icons");

    $blee = new Dropdown(F::icon("widget"));
    $blee->closeOnBodyClick()
            ->align("bottom left")
            ->addCssClass("sphp-f6-info large")
            ->ajaxPrepend("manual/snippets/f6ScreenInfo.php");

    //$ul[] = $blee;
    $ul->appendLink("https://github.com/samhol/SPHP-framework", '<i class="fa fa-github"></i>', "_blank")
            ->appendLink("https://www.facebook.com/Sami.Petteri.Holck.Programming/", '<i class="fa fa-facebook-square"></i>', "_blank")
            ->appendLink("https://twitter.com/SPHPframework", '<i class="fa fa-twitter"></i>', "_blank")
            ->appendLink("https://plus.google.com/b/113942361282002156141/113942361282002156141", '<i class="fa fa-google-plus-square"></i>', "_blank")
            ->addCssClass("no-bullet")
            ->printHtml();
    ?>
  </div>
  <?php
  include_once("manual/__topBar.php");
  ?>
  <div class="row expanded small-collapse medium-uncollapse">
    <div class="column medium-3 large-3 xlarge-2 show-for-large">

      <?php
      include_once("manual/sidenav.php");
      ?>
    </div>
    <div class="mainContent small-12 large-9 xlarge-8 column"> 
      <pre>

        <?php
        include_once "manual/manualTools/main.php";

        /*
          [NOTE BY danbrown AT php DOT net: The array_diff_assoc_recursive function is a
          combination of efforts from previous notes deleted.
          Contributors included (Michael Johnson), (jochem AT iamjochem DAWT com),
          (sc1n AT yahoo DOT com), and (anders DOT carlsson AT mds DOT mdh DOT se).]
         */

        function arrayRecursiveDiff($aArray1, $aArray2) {
          $aReturn = array();

          foreach ($aArray1 as $mKey => $mValue) {
            if (array_key_exists($mKey, $aArray2)) {
              if (is_array($mValue)) {
                $aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]);
                if (count($aRecursiveDiff)) {
                  $aReturn[$mKey] = $aRecursiveDiff;
                }
              } else {
                if ($mValue !== $aArray2[$mKey]) {
                  $aReturn[$mKey] = $mValue;
                }
              }
            } else {
              $aReturn[$mKey] = $mValue;
            }
          }

          return $aReturn;
        }

        $a1 = Array
            (
            "0" => Array
                (
                "file" => "newhotfolder.gif",
                "path" => "images/newhotfolder.gif",
                "type" => "gif",
                "size" => "1074",
                "md5" => "123812asdkbqw98eqw80hasdas234234"
            ),
            "1" => Array
                (
                "file" => "image.gif",
                "path" => "images/attachtypes/image.gif",
                "type" => "gif",
                "size" => "625",
                "[md5]" => "7bbb66e191688a86b6f42a03bd412a6b"
            ),
            "2" => Array
                (
                "file" => "header.gif",
                "path" => "images/attachtypes/header.gif",
                "type" => "gif",
                "size" => "625",
                "md5" => "71291239asskf9320234kasjd8239393"
            )
        );
        $a2 = Array
            (
            "0" => Array
                (
                "file" => "newhotfolder.gif",
                "path" => "images/newhotfolder.gif",
                "type" => "gif",
                "size" => "1074",
                "md5" => "8375h5910423aadbef67189c6b687ff51c"
            ),
            "1" => Array
                (
                "file" => "image.gif",
                "path" => "images/attachtypes/image.gif",
                "type" => "gif",
                "size" => "625",
                "[md5]" => "7bbb66e191688a86b6f42a03bd412a6b"
            ),
            "2" => Array
                (
                "file" => "header.gif",
                "path" => "images/attachtypes/footer.gif",
                "type" => "gif",
                "size" => "625",
                "md5" => "1223819asndnasdn2213123nasd921"
            )
        );

        var_dump(arrayRecursiveDiff($a1, $a2));
        print_r(arrayRecursiveDiff(
                        [1, [[1, new \stdClass], 3, 2], 7], [1, [[1, new \stdClass, new \stdClass], 2, 3]]));
        ?>
    </div>
    <div class="show-for-xlarge xlarge-2 column"> 

    </div>
  </div>


  <?php
  include_once("manual/_footer_.php");

  use Sphp\Html\Apps\BackToTopButton as BackToTopButton;

$backToTopBtn = new BackToTopButton();
  $backToTopBtn
          ->setTitle("Back To Top")
          ->printHtml();
  $html->documentClose();
  ?>
