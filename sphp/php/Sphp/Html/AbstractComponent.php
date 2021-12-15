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

use Sphp\Html\Exceptions\HtmlException;

/**
 * Abstract Class provides a simple implementation of the component containing other components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractComponent extends AbstractTag {

  /**
   * Returns opening tag with its attributes
   *
   * @return string opening tag with attributes
   */
  public function getOpeningTag(): string {
    return '<' . $this->getTagName() . $this->attributesToString() . '>';
  }

  /**
   * Returns the content of the component as a string
   *
   * @return string content as a string
   * @throws HtmlException if content parsing fails
   */
  abstract public function contentToString(): string;

  /**
   * Returns closing tag
   *
   * @return string closing tag
   */
  public function getClosingTag(): string {
    return '</' . $this->getTagName() . '>';
  }

  public function getHtml(): string {
    return $this->getOpeningTag() . $this->contentToString() . $this->getClosingTag();
  }

}
