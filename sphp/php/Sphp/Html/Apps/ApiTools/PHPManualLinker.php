<?php

/**
 * PHPManualLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\ApiTools;

use Sphp\Html\Hyperlink as Hyperlink;
use Sphp\Core\Types\Strings as Strings;

/**
 * Link generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PHPManualLinker extends ApiLinker {

  use PHPManualTrait;

  /**
   * Constructs a new instance
   *
   * @param string $manualRoot the url pointing to the PHP documentation
   * @param string $attrs the default value of the target attribute
   *        for the generated links
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($manualRoot = "https://secure.php.net/manual/en/", $attrs = ["target" => "php.net", "class" => ["external", "phpman", "api"]]) {
    parent::__construct($manualRoot, $attrs);
  }

  /**
   * {@inheritdoc}
   */
  public function classLinker($class) {
    return new PHPManualClassLinker($this->getApiRoot(), $class, $this->getDefaultAttributes());
  }

  /**
   * Returns a hyperlink object pointing to PHP's predefined constants page
   *
   * @param  string $constant the name of the constant
   * @return Hyperlink hyperlink object pointing to PHP's predefined constants page
   */
  public function getConstantLink($constant) {
    $path = "reserved.constants.php";
    if (defined($constant)) {
      $path = "reserved.constants.php#constant." . $this->phpPathFixer($constant);
      return $this->getHyperlink($path, $constant, "$constant cnnstant")
                      ->addCssClass("constant");
    } else {
      return $this->getHyperlink($path, $constant, "$constant cnnstant")
                      ->addCssClass("constant");
    }
  }

  /**
   * Returns a hyperlink object pointing to an PHP function page
   *
   * @param  string $funName the name of the function
   * @return Hyperlink hyperlink object pointing to an PHP function page
   */
  public function getFunctionLink($funName) {
    $path = "function." . $this->phpPathFixer($funName);
    return $this->getHyperlink($path, $funName, "$funName() method")->addCssClass("function");
  }

  /**
   * Returns a hyperlink object pointing to the PHP extension in the PHP documentation
   *
   * @param  string $extName the name of the PHP extension (case insensitive)
   * @param  string $linkText optional text of the hyperlink
   * @return Hyperlink hyperlink object pointing to the PHP extension in the PHP
   *         documentation
   */
  public function getExtensionLink($extName, $linkText = "") {
    $path = strtolower($extName);
    if (Strings::isEmpty($linkText)) {
      $linkText = $extName;
    }
    return $this->getHyperlink("book." . $path, $linkText, $extName);
  }

  /**
   * Returns a hyperlink object pointing to the PHP type documentation
   *
   * @param  mixed|string $type the PHP työe or the name of the PHP type
   * @param  string $linkText optional text of the hyperlink
   * @return Hyperlink hyperlink object pointing to the PHP type documentation page
   */
  public function getTypeLink($type, $linkText = "") {
    $typename = strtolower(gettype($type));
    if ($typename === "string") {
      $typename = strtolower($type);
    }
    if ($typename === "double") {
      $typename = "float";
    }
    if (Strings::isEmpty($linkText)) {
      $linkText = $typename;
      if ($linkText === "null") {
        $linkText = "null";
      }
    }
    if ($typename === "null") {
      $title = "null type";
    } else {
      $title = "$typename type";
    }
    return $this->getHyperlink("language.types.$typename", $linkText, $title)
                    ->removeCssClass("api phpman");
  }

  /**
   * Returns a hyperlink object pointing to the PHP control structure in the PHP documentation
   *
   * @param  string $controlName the name of the PHP control structure (case insensitive)
   * @param  string $linkText the text of the link
   * @return Hyperlink hyperlink object pointing to the PHP control structure in the PHP
   *         documentation
   */
  public function getControlStructLink($controlName) {
    $path = strtolower($controlName);
    return $this->getHyperlink("control-structures." . $path, $controlName, $controlName);
  }

}
