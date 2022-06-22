<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeContainer;

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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SimpleTag extends AbstractComponent {

  /**
   * the content of the component
   */
  private string|int|float|null $content;

  /**
   * Constructor
   * 
   * @param  string $tagName the name of the tag
   * @param  string|int|float|null $content the content of the component
   * @param  AttributeContainer|null $attrManager the attribute manager of the component
   * @throws \InvalidArgumentException if the tagname is not valid
   * @link   https://php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct(string $tagName, string|int|float|null $content = null, ?AttributeContainer $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    $this->setContent($content);
  }

  /**
   * Sets the content of the component
   * 
   * @param  string|int|float|null $content the content of the component
   * @return $this for a fluent interface
   */
  public function setContent(string|int|float|null $content) {
    $this->content = $content;
    return $this;
  }

  /**
   * Returns the content of the component
   * 
   * @return string|int|float|null $content the content of the component
   */
  public function getContent(): string|int|float|null {
    return $this->content;
  }

  /**
   * Returns the content of the component
   * 
   * @return string the content of the component
   */
  public function contentToString(): string {
    return (string) $this->content;
  }

}
