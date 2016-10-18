<?php

/**
 * AbstractComponent.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeManager;
use Sphp\Html\Programming\ScriptInterface;
use Sphp\Html\Programming\ScriptsContainer;

/**
 * Class AbstractComponent provides a simple implementation of the {@link Tag}.
 *
 * AbstractComponent makes it possible to create new HTML components by composition
 * of other existing HTML components.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractJavaScriptComponent extends AbstractContainerComponent {

  /**
   * container for appended script components
   *
   * @var ScriptsContainer
   */
  private $scripts;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a PHP
   * string or to an array of strings. So also an object of any class that
   * implements magic method `__toString()` is allowed.
   *
   * @param string $tagName the name of the container tag
   * @param mixed $content component's content
   * @param  AttributeManager|null $attrManager the attribute manager of the component
   */
  public function __construct($tagName, $content = null, AttributeManager $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    if ($content !== null) {
      $this->getInnerContainer()->append($content);
    }
    $this->scripts = new ScriptsContainer();
  }

  /**
   * Appends the required script tags for the component
   *
   * All {@link Script} components are placed after the component
   * in the HTML document.
   *
   * @param  ScriptInterface $script the script paths
   * @return ScriptsContainer
   */
  protected function scriptsContainer() {
    //$this->scripts;
    return $this->scripts;
  }

  /**
   * Returns the component as html-markup string
   *
   * @return string html-markup of the component
   * @throws \Exception if html parsing fails
   */
  public function getHtml() {
    $output = parent::getHtml() . $this->scripts;
    return $output;
  }

  /**
   * Clones the component
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    parent::__clone();
  }

}
