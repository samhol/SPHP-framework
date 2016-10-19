<?php

/**
 * AbstractSimpleContainerTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeManager as HtmlAttributeManager;
use Sphp\Core\Types\Strings;

/**
 * Class is the base class for all HTML tag components acting as HTML component containers
 *
 * **Notes:**
 *
 * Any class extending {@link self} follows these rules:
 * 
 * 1. Any extending class act as a container for other {@link HtmlContent}, text, etc.
 * 2. The type of the content in such container depends solely on the container's purpose of use.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-05-03
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractSimpleContainerTag extends AbstractTag {

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
   * 1. Parameter `mixed $content` can be of any type that converts to a string 
   *    or to an array of strigs. So also objects of any type that implement magic 
   *    method `__toString()` are allowed.
   *
   * @param  string $tagName the name of the tag
   * @param  mixed $content the content of the component
   * @param  AttributeManager|null $attrManager the attribute manager of the component
   * @param  ContainerInterface $contentContainer the inner content container of the component
   * @throws \InvalidArgumentException if the tagname is not valid
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($tagName, $content = null, HtmlAttributeManager $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    if ($content !== null) {
      $this->setContent($content);
    }
  }

  /**
   * Sets the content of the component
   * 
   * @param  mixed $content the inner content container of the component
   * @return self for PHP Method Chaining
   */
  protected function setContent($content = null) {
    $this->content = $content;
    return $this;
  }

  /**
   * Returns the content of the component
   * 
   * @return mixed the content of the component
   */
  protected function getContent() {
    return $this->content;
  }

  /**
   * Returns opening tag with its attributes
   *
   * @return string opening tag with attributes
   */
  protected function getOpeningTag() {
    $attrs = "" . $this->attrs();
    if ($attrs != "") {
      $attrs = " " . $attrs;
    }
    return "<" . $this->getTagName() . $attrs . ">";
  }

  /**
   * Returns the content of the component as a string
   *
   * @return string content as a string
   * @throws \Exception if content parsing fails
   */
  public function contentToString() {
    return Strings::toString($this->content);
  }

  /**
   * Returns closing tag
   *
   * @return string closing tag
   */
  protected function getClosingTag() {
    return "</" . $this->getTagName() . ">";
  }

  /**
   * Returns the component as html-markup string
   *
   * @return string html-markup of the component
   * @throws \Exception if html parsing fails
   */
  public function getHtml() {
    return $this->getOpeningTag() . $this->contentToString() . $this->getClosingTag();
  }

  public function __clone() {
    $this->content = clone $this->content;
    parent::__clone();
  }

}
