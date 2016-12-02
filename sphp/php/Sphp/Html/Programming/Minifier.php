<?php

/**
 * Scripts.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\ContentInterface;

/**
 * Class is a container for a {@link Meta} component group
 *
 *  The &lt;meta&gt; tag provides metadata about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parsable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-10-29
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Minifier implements ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    session_start();
  }

  /**
   * Adds an empty script tag with src - and type attribute to the object
   *
   * @param  string $src script's file path (src attribute)
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   */
  public function appendSrc($src) {
    if (!array_key_exists("script_files", $_SESSION) || !is_array($_SESSION["script_files"])) {
      $_SESSION["script_files"] = [];
    }
    if (is_array($src)) {
      foreach ($src as $s) {
        $this->appendSrc($s);
      }
    }
    if (!in_array($src, $_SESSION["script_files"])) {
      $_SESSION["script_files"][] = $src;
    }
    return $this;
  }

  public function hasScripts() {
    return array_key_exists("script_files", $_SESSION) && is_array($_SESSION["script_files"]) && count($_SESSION["script_files"]) > 0;
  }

  public function getScripts() {
    $files = function() {
      $output = "";
      if ($this->hasScripts()) {
        foreach ($_SESSION["script_files"] as $file) {
          $output.=\Sphp\Util\FileUtils::executePhpToString($file);
        }
      }
      return $output;
    };
    $src1 = new \Minify_Source([
        'id' => 'source1',
        'getContentFunc' => $files,
        'contentType' => \Minify::TYPE_JS,
        'lastModified' => ($_SERVER['REQUEST_TIME'] - $_SERVER['REQUEST_TIME'] % 86400),
    ]);
    echo $src1();
    /* $minPath = null;
      if (count($_SESSION["script_files"]) > 0) {
      $minPath = "min/?f=" . implode(",", $_SESSION["script_files"]);
      //echo \Sphp\Util\FileUtils::fileToString(\Sphp\HTTP_ROOT . $minPath);
      } */
  }

  /**
   * Returns the component as HTML markup string
   *
   * @return string HTML markup of the component
   * @throws \Exception if html parsing fails
   */
  public function getHtml() {
    return $this->getScripts(); //.(new Script())->setSrc("min/?f=".$getHtml($this->scripts))->getHtml();
  }

}
