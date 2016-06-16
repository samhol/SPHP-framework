<?php

/**
 * AbstractFoundationComponent.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\AbstractContainerComponent as AbstractContainerComponent;
use Sphp\Html\ContainerInterface as ContainerInterface;

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
abstract class AbstractFoundationComponent extends AbstractContainerComponent {

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
   * @param  FoundationAttributeManager|null $attrManager the attribute manager of the component
   * @param  ContainerInterface|null $contentContainer the inner content container of the component
   * @throws \InvalidArgumentException if the tagname is not valid
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($tagName, FoundationAttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    if ($attrManager === null) {
      $attrManager = new FoundationAttributeManager();
    }
    parent::__construct($tagName, $attrManager, $contentContainer);
  }

  /**
   * Returns the 'data-option' attribute object
   *
   * @return PropertyAttribute the 'data-option' attribute object
   */
  public function dataOptions() {
    return $this->attrs()->dataOptions();
  }

}
