<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use ReflectionClass;
use Sphp\Html\Navigation\Hyperlink;

/**
 * Hyperlink object generator pointing to an existing API documentation about a class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.apigen.org/ ApiGen
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractClassLinker extends AbstractLinker implements ClassLinker {

  /**
   * class reflector
   *
   * @var ReflectionClass
   */
  protected $ref;

  /**
   * Constructor
   *
   * @param string $class class name or object
   * @param ApiUrlGeneratorInterface $pathParser
   */
  public function __construct(string $class, ApiUrlGeneratorInterface $pathParser) {
    parent::__construct($pathParser);
    $this->ref = new ReflectionClass($class);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->ref);
    parent::__destruct();
  }

  public function __clone() {
    $this->ref = new ReflectionClass($this->ref->getName());
    parent::__clone();
  }

  public function __toString(): string {
    return $this->getLink()->getHtml();
  }

  public function hyperlink(string $url = null, string $content = null, string $title = null): Hyperlink {
    return parent::hyperlink($url, str_replace("\\", "\\<wbr>", $content), $title);
  }

  public function getLink(string $name = null, string $title = null): Hyperlink {
    if ($name === null) {
      $name = $this->ref->getShortName();
    }
    $longName = $this->ref->getName();
    if ($title === null) {
      if ($this->ref->isInterface()) {
        $title = "Interface $longName";
      } else if ($this->ref->isTrait()) {
        $title = "Trait $longName";
      } else if ($this->ref->isAbstract()) {
        $title = "Abstract class $longName";
      } else {
        $title = "Class $longName";
      }
    }
    return $this->hyperlink($this->urls()->getClassUrl($longName), $name, $title);
  }

  public function methodLink(string $method, bool $full = true): Hyperlink {
    if ($full) {
      $text = $this->ref->getShortName() . "::$method()";
    } else {
      $text = "$method()";
    }
    $fullClassName = $this->ref->getName();
    try {
      $reflectedMethod = $this->ref->getMethod($method);
      if ($reflectedMethod->isConstructor()) {
        $title = "The $fullClassName constructor";
      } else if ($reflectedMethod->isStatic()) {
        $title = "Static method: $fullClassName::$reflectedMethod->name()";
      } else {
        $title = "Instance method: $fullClassName::$reflectedMethod->name()";
      }
    } catch (\Exception $ex) {
      $title = "Method: $fullClassName::$method()";
    }
    return $this->hyperlink($this->urls()->getClassMethodUrl($fullClassName, $method), $text, $title);
  }

  public function constantLink(string $constName): Hyperlink {
    $name = $this->ref->getShortName() . "::$constName";
    $title = $this->ref->getName() . "::$constName constant";
    return $this->hyperlink($this->urls()->getClassConstantUrl($this->ref->getName(), $constName), $name, $title);
  }

  public function namespaceLink(bool $full = true): Hyperlink {
    $fullName = $this->ref->getNamespaceName();
    if (!$full) {
      $namespaceArray = explode('\\', $fullName);
      $name = array_pop($namespaceArray);
    } else {
      $name = $fullName;
    }
    $title = "$fullName namespace";
    return $this->hyperlink($this->urls()->getNamespaceUrl($fullName), $name, $title);
  }

}
