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

  /**
   * Constructs a new instance
   *
   * @param string|null $defaultTarget the default target used in the generated links or `null` for none
   * @param string|null $defaultCssClasses the default CSS classes used in the generated links or `null` for none
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function __construct($defaultTarget = null, $defaultCssClasses = ['api', 'phpman']) {
    parent::__construct(new PHPManualUrlGenerator(), $defaultTarget);
    $this->setDefaultCssClasses($defaultCssClasses);
  }

  public function hyperlink($url = null, $content = null, $title = null) {
    if ($title === null) {
      $title = 'PHP manual';
    } else {
      $title = 'PHP manual: ' . $title;
    }
    return parent::hyperlink($url, $content, $title);
  }

  public function classLinker($class) {
    return new PHPManualClassLinker($class, $this->getUrlGenerator(), $this->getDefaultTarget(), $this->getDefaultCssClasses());
  }

  public function constantLink($constant) {
    $path = $this->getUrlGenerator()->getConstantUrl($constant);
    return $this->hyperlink($path, $constant, "$constant cnnstant")
                    ->addCssClass('constant');
  }

  public function functionLink($funName) {
    $path = $this->getUrlGenerator()->getFunctionUrl($funName);
    return $this->hyperlink($path, $funName, "$funName() function")->addCssClass('function');
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
    return $this->hyperlink($this->getUrlGenerator()->getRoot() . "book." . $path, $linkText, $extName);
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
    }
    if ($typename === 'null') {
      $title = 'null type';
    } else {
      $title = "$typename type";
    }
    return $this->hyperlink($this->getUrlGenerator()->getRoot() . "language.types.$typename", $linkText, $title)
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
    return $this->hyperlink($this->getUrlGenerator()->getRoot() . "control-structures." . $path, $controlName, $controlName);
  }

}
