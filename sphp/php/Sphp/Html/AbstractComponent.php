<?php

/**
 * AbstractComponent.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeManager as AttributeManager;
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
abstract class AbstractComponent extends AbstractTag {

  /**
   * the content of the component
   *
   * @var ContainerInterface
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
   * @param  AttributeManager|null $attrManager the attribute manager of the component
   * @param  ContainerInterface|null $contentContainer the inner content container of the component
   * @throws \InvalidArgumentException if the tagname is not valid
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($tagName, AttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    parent::__construct($tagName, $attrManager);
    $this->setContentContainer($contentContainer);
  }

  /**
   * {@inheritdoc}
   */
  public function __destruct() {
    unset($this->content);
    parent::__destruct();
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    $this->content = clone $this->content;
    parent::__clone();
  }

  /**
   * Sets the inner content container of the component
   *
   * @param  ContainerInterface $contentContainer the inner content container of the component
   * @return self for PHP Method Chaining
   */
  protected function setContentContainer(ContainerInterface $contentContainer = null) {
    if (!($contentContainer instanceof ContainerInterface)) {
      $this->content = new Container();
    } else {
      $this->content = $contentContainer;
    }
    return $this;
  }

  /**
   * Returns the content container or an element pointed by an optional index
   *
   * @param  mixed $offset optional index with the content element
   * @return ContainerInterface|mixed the content container
   */
  protected function content($offset = null) {
    $content = $this->content;
    if ($offset !== null) {
      $content = $this->content->get($offset);
    }
    return $content;
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
    return $this->content->getHtml();
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

}
