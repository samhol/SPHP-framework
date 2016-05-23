<?php

/**
 * ApiLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\ApiTools;

use Sphp\Util\ReflectionClassExt as ReflectionClassExt;
use Sphp\Html\Navigation\Hyperlink as Hyperlink;
use Sphp\Html\Foundation\Buttons\HyperlinkButton as HyperlinkButton;
use Sphp\Html\Foundation\Buttons\ButtonGroup as ButtonGroup;
use Sphp\Util\Strings as Strings;

/**
 * Link generator pointing to an existing API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class ApiLinker extends AbstractLinker {

  /**
   * Constructs a new instance
   *
   * @param string $apiRoot the url pointing to the API documentation
   * @param scalar[] $attrs the default value of the attributes used in the
   *        generated links
   */
  public function __construct($apiRoot = "", array $attrs = ["target" => "api", "class" => "api"]) {
    parent::__construct($apiRoot, $attrs);
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return "" . $this->getHyperlink();
  }

  /**
   * {@inheritdoc}
   */
  public function getHyperlink($relativeUrl = null, $content = null, $title = null) {
    if (Strings::isEmpty($content)) {
      $content = $relativeUrl;
    }
    return parent::getHyperlink($relativeUrl, str_replace("\\", "\\<wbr>", $content), $title);
  }

  /**
   * Return the class property linker
   *
   * @param  string|\object $class class name or object
   * @return AbstractClassLinker the class property linker
   */
  abstract public function classLinker($class);

  /**
   * Returns a hyperlink object pointing to an API class page
   *
   * @param  string|\object $class class name or object
   * @param  null|string $name the alternative class link content
   * @return Hyperlink hyperlink object pointing to an API class page
   */
  public function getClassLink($class, $name = null) {
    return $this->classLinker($class)->getLink($name);
  }

  /**
   * Returns a hyperlink object pointing to class method in the API documentation
   *
   * @param  string|\object $class class name or object
   * @param  string $method the method name
   * @return Hyperlink object pointing to class method in the API documentation
   */
  public function getClassMethodLink($class, $method) {
    return $this->classLinker($class)->method($method);
  }

  /**
   * Returns a hyperlink object pointing to class constant in the API documentation
   *
   * @param  string|\object $class class name or object
   * @param  string $constantName the constant name
   * @return Hyperlink object pointing to class constant in the API documentation
   */
  public function getClassConstantLink($class, $constantName) {
    return $this->classLinker($class)->constant($constantName);
  }

  /**
   * Returns a hyperlink object pointing to an API namespace page
   *
   * @param  string $namespace namespace name
   * @param  boolean $fullName true if the full namespace name is visible, false otherwise
   * @return Hyperlink hyperlink object pointing to an API namespace page1
   */
  public function getNamespaceLink($namespace, $fullName = true) {
    $ns = ReflectionClassExt::parseNamespace($namespace);
    $path = str_replace('\\', '.', $ns);
    if ($fullName) {
      $name = $ns;
    } else {
      $nsArr = ReflectionClassExt::parseNamespaceToArray($namespace);
      $name = array_pop($nsArr);
    }
    return $this->getHyperlink("namespace-" . $path . ".html", $name, "The $ns namespace")
                    ->addCssClass("bordered");
  }

}
