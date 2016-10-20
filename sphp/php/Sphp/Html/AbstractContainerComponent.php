<?php

/**
 * AbstractContainerComponent.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeManager;

/**
 * Class provides a simple implementation of a container tag
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
abstract class AbstractContainerComponent extends AbstractComponent {

  /**
   * the inner content container
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
    $this->setInnerContainer($contentContainer);
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
   * Sets the inner content container of the component
   *
   * @param  ContainerInterface $contentContainer the inner content container of the component
   * @return self for PHP Method Chaining
   */
  protected function setInnerContainer(ContainerInterface $contentContainer = null) {
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
  protected function getInnerContainer() {
    return $this->content;
  }

  public function contentToString() {
    return $this->content->getHtml();
  }

}
