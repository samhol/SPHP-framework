<?php

/**
 * SimpleContainerTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Stdlib\Strings;

/**
 * Base for all simple container tags
 *
 * **Notes:**
 *
 * Any extending class follows these rules:
 * 
 * 1. Any extending class act as a container for other HTML content, text, etc.
 * 2. The type of the content in such container depends solely on the container's purpose of use.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SimpleContainerTag extends AbstractTag {

  /**
   * the content of the component
   *
   * @var mixed
   */
  private $content;

  /**
   * Constructs a new instance
   * 
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a string 
   * or to an array of strings. So also objects of any type that implement magic 
   * method `__toString()` are allowed.
   *
   * @param  string $tagName the name of the tag
   * @param  mixed $content the content of the component
   * @param  HtmlAttributeManager|null $attrManager the attribute manager of the component
   * @param  ContainerInterface $contentContainer the inner content container of the component
   * @throws \InvalidArgumentException if the tagname is not valid
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct(string $tagName, $content = null, HtmlAttributeManager $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    if ($content !== null) {
      $this->setContent($content);
    }
  }

  public function __destruct() {
    unset($this->content);
    parent::__destruct();
  }

  public function __clone() {
    $this->content = clone $this->content;
    parent::__clone();
  }

  /**
   * Sets the content of the component
   * 
   * @param  mixed $content the inner content container of the component
   * @return $this for a fluent interface
   */
  public function setContent($content = null) {
    $this->content = $content;
    return $this;
  }

  /**
   * Returns the content of the component
   * 
   * @return mixed the content of the component
   */
  public function getContent() {
    return $this->content;
  }

  public function getHtml(): string {
    $attrs = '' . $this->attrs();
    if ($attrs !== '') {
      $attrs = ' ' . $attrs;
    }
    $output = '<' . $this->getTagName() . $attrs . '>';
    return $output . $this->content . '</' . $this->getTagName() . '>';
  }

}
