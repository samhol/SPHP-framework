<?php

/**
 * PHPManual.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Hyperlink;

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
    parent::__construct(new ApiLinkPathGenerator('https://secure.php.net/manual/en/', $defaultTarget));
    $this->setDefaultCssClasses($defaultCssClasses);
  }

  public function classLinker($class) {
    $gen = new PHPManualClassPathParser($class, $this->getLinkGenerator()->getApiRoot(), $this->getLinkGenerator()->getTarget());
    return new PHPManualClassLinker($class,$gen);
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
    $path = $this->getLinkGenerator()->getApiRoot()."function." . $this->phpPathFixer($funName);
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
  public function extensionLink($extName, $linkText = null) {
    $path = strtolower($extName);
    if ($linkText === null) {
      $linkText = $extName;
    }
    return $this->hyperlink($this->getLinkGenerator()->getApiRoot()."book." . $path, $linkText, $extName);
  }

  /**
   * Returns a hyperlink object pointing to the PHP type documentation
   *
   * @param  mixed|string $type the PHP työe or the name of the PHP type
   * @param  string $linkText optional text of the hyperlink
   * @return Hyperlink hyperlink object pointing to the PHP type documentation page
   */
  public function typeLink($type, $linkText = null) {
    $typename = strtolower(gettype($type));
    if ($typename === 'string') {
      $typename = strtolower($type);
    }
    if ($typename === 'double') {
      $typename = 'float';
    }
    if ($linkText === null) {
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
    return $this->hyperlink($this->getLinkGenerator()->getApiRoot()."language.types.$typename", $linkText, $title)
                    ->addCssClass('type');
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
    return $this->hyperlink($this->getLinkGenerator()->getApiRoot()."control-structures." . $path, $controlName, $controlName);
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
