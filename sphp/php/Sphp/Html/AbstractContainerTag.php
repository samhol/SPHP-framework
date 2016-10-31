<?php

/**
 * AbstractContainerTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use IteratorAggregate;

/**
 * Class is the base class for all HTML tag components acting as HTML component containers
 *
 * **Notes:**
 *
 * All containers follow these rules:
 *
 * 1. Any extending class act as a container for other components like
 *    {@link ContentInterface}, other objects, text, ...etc.
 * 2. The type of the content in a container depends solely on the container's
 *    purpose of use.
 * 3. Any extending class can be used in **PHP**'s `foreach` construct.
 * 4. Any extending class can be used with the **PHP**'s `count()` function.
 * 5. All container's content data can be reached by PHP's {@link \ArrayAccess}
 *    notation.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-05-03
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractContainerTag extends AbstractContainerComponent implements IteratorAggregate, ContainerComponentInterface, ContentParserInterface {

  use ContainerComponentTrait,
      ContentParsingTrait,
      TraversableTrait;

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
   * @param  ContainerInterface|null $contentContainer the inner content container of the component
   * @throws \InvalidArgumentException if the tagname is not valid
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($tagName, AttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    parent::__construct($tagName, $attrManager, $contentContainer);
  }

}
