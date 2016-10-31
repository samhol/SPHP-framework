<?php

/**
 * PHPManual.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Hyperlink;
use Sphp\Core\Types\Strings;

/**
 * Link generator pointing to an exising PHP manual documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PHPManual extends AbstractPhpApiLinker {

  use PHPManualTrait;

  /**
   *
   * @var self
   */
  private static $instance;

  /**
   * Constructs a new instance
   *
   * @param string|null $defaultTarget the default target used in the generated links or `null` for none
   * @param string|null $defaultCssClasses the default CSS classes used in the generated links or `null` for none
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function __construct($defaultTarget = '_blank', $defaultCssClasses = 'api phpman') {
    parent::__construct('https://secure.php.net/manual/en/', $defaultTarget);
    $this->setDefaultCssClasses($defaultCssClasses);
  }

  public function classLinker($class) {
    return new PHPManualClassLinker($this->getApiRoot(), $class, new PHPManualClassPathParser($class), $this->getDefaultTarget(), $this->getDefaultCssClasses());
  }

  /**
   * Returns a hyperlink object pointing to PHP's predefined constants page
   *
   * @param  string $constant the name of the constant
   * @return Hyperlink hyperlink object pointing to PHP's predefined constants page
   */
  public function constantLink($constant) {
    $path = 'reserved.constants.php';
    if (defined($constant)) {
      $path = 'reserved.constants.php#constant.' . $this->phpPathFixer($constant);
      return $this->hyperlink($path, $constant, "$constant cnnstant")
                      ->addCssClass('constant');
    } else {
      return $this->hyperlink($path, $constant, "$constant cnnstant")
                      ->addCssClass('constant');
    }
  }

  /**
   * Returns a hyperlink object pointing to an PHP function page
   *
   * @param  string $funName the name of the function
   * @return Hyperlink hyperlink object pointing to an PHP function page
   */
  public function functionLink($funName) {
    $path = "function." . $this->phpPathFixer($funName);
    return $this->hyperlink($path, $funName, "$funName() method")->addCssClass('function');
  }

  /**
   * Returns a hyperlink object pointing to the PHP extension in the PHP documentation
   *
   * @param  string $extName the name of the PHP extension (case insensitive)
   * @param  string $linkText optional text of the hyperlink
   * @return Hyperlink hyperlink object pointing to the PHP extension in the PHP
   *         documentation
   */
  public function extensionLink($extName, $linkText = '') {
    $path = strtolower($extName);
    if (Strings::isEmpty($linkText)) {
      $linkText = $extName;
    }
    return $this->hyperlink("book." . $path, $linkText, $extName);
  }

  /**
   * Returns a hyperlink object pointing to the PHP type documentation
   *
   * @param  mixed|string $type the PHP työe or the name of the PHP type
   * @param  string $linkText optional text of the hyperlink
   * @return Hyperlink hyperlink object pointing to the PHP type documentation page
   */
  public function typeLink($type, $linkText = "") {
    $typename = strtolower(gettype($type));
    if ($typename === 'string') {
      $typename = strtolower($type);
    }
    if ($typename === 'double') {
      $typename = 'float';
    }
    if (Strings::isEmpty($linkText)) {
      $linkText = $typename;
      if ($linkText === 'null') {
        $linkText = 'null';
      }
    }
    if ($typename === 'null') {
      $title = 'null type';
    } else {
      $title = "$typename type";
    }
    return $this->hyperlink("language.types.$typename", $linkText, $title)
                    ->removeCssClass('api phpman');
  }

  /**
   * Returns a hyperlink object pointing to the PHP control structure in the PHP documentation
   *
   * @param  string $controlName the name of the PHP control structure (case insensitive)
   * @param  string $linkText the text of the link
   * @return Hyperlink hyperlink object pointing to the PHP control structure in the PHP
   *         documentation
   */
  public function controlStructLink($controlName) {
    $path = strtolower($controlName);
    return $this->hyperlink("control-structures." . $path, $controlName, $controlName);
  }

  /**
   * 
   * @param  string|null $path
   * @return self default instance of linker
   */
  public static function get() {
    if (self::$instance === null) {
      self::$instance = (new static());
    }

    return self::$instance;
  }

}
