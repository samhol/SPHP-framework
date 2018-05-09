<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Exceptions\SphpException;

/**
 * Hyperlink generator pointing to an online PHP API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractPhpApiLinker extends AbstractLinker {

  /**
   * @var string
   */
  private $ns;

  /**
   * @var string
   */
  private $classLinkerType;

  /**
   * Constructor
   *
   * @param  ApiUrlGeneratorInterface $urlGenerator
   * @param  string $classLinkerType
   * @param  string $namespace
   * @throws SphpException
   */
  public function __construct(ApiUrlGeneratorInterface $urlGenerator, string $classLinkerType, string $namespace = null) {
    $this->ns = $namespace;
    if (!is_a($classLinkerType, ClassLinker::class, true)) {
      throw new SphpException("$classLinkerType in not a subtype of " . ClassLinker::class);
    }
    $this->classLinkerType = $classLinkerType;
    parent::__construct($urlGenerator);
  }

  /**
   * Returns linker properties or hyperlinks
   * 
   * @param  string $name
   * @return Hyperlink|Sami
   * @throws SphpException
   */
  public function __get(string $name) {
    $test = $this->ns . "\\$name";
    //echo "\npath: $test";
    if (is_callable($test)) {
      return $this->functionLink($test);
    } else if (class_exists($test) || interface_exists($test) || trait_exists($test)) {
      return $this->classLinker($test);
    } else if (defined($test)) {
      return $this->constantLink($test);
    } else {
      $chain = new static($this->urls(), $this->ns . "\\$name");
      $chain->setDefaultHyperlinkAttributes($this->getDefaultHyperlinkAttributes());
      return $chain;
    }
  }

  /**
   * Returns the class property linker for the given class
   * 
   * @param  string $class class name or object
   * @return ClassLinker new instance
   * @throws SphpException if the class name does not exist
   */
  public function classLinker(string $class): ClassLinker {
    $classLinkerType = $this->classLinkerType;
    if (class_exists($class) || interface_exists($class) || trait_exists($class)) {
      $classLinker = new $classLinkerType($class, $this->urls());
    } else {
      $test = $this->ns . "\\$class";
      if (class_exists($test) || interface_exists($test) || trait_exists($test)) {
        $classLinker = new $classLinkerType($test, $this->urls());
      } else {
        throw new SphpException("Class '$class' does not exist");
      }
    }
    $classLinker->setDefaultHyperlinkAttributes($this->getDefaultHyperlinkAttributes());
    return $classLinker;
  }

  public function hyperlink(string $url = null, string $content = null, string $title = null): Hyperlink {
    if ($content === null) {
      $content = $url;
    }
    return parent::hyperlink($url, str_replace('\\', '\\<wbr>', $content), $title);
  }

  /**
   * Returns a hyperlink object pointing to an API page describing PHP function 
   *
   * @param  string $function the name of the function
   * @param  string $linkText optional link text
   * @return Hyperlink hyperlink object pointing to the documentation
   */
  public function functionLink(string $function, string $linkText = null): Hyperlink {
    if ($linkText === null) {
      $linkText = $function;
    }
    $path = $this->urls()->getFunctionUrl($function);
    return $this->hyperlink($path, $function, "function $function()")
                    ->addCssClass('function');
  }

  /**
   * Returns a hyperlink object pointing to an API page describing PHP constant 
   * 
   * @param  string $constant the name of the constant
   * @param  string $linkText optional link text
   * @return Hyperlink hyperlink object pointing to the documentation
   */
  public function constantLink(string $constant, string $linkText = null): Hyperlink {
    if ($linkText === null) {
      $linkText = $constant;
    }
    $path = $this->urls()->getConstantUrl($constant);
    return $this->hyperlink($path, $linkText, "$constant constant")
                    ->addCssClass('constant');
  }

}
