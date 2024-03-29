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
 * Implements an empty tag
 *
 * Empty tag has only attributes and no content
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class EmptyTag extends AbstractTag {

  private bool $close = false;

  /**
   * Constructor
   * 
   * @param string $tagName
   * @param bool $useCloseTag
   * @param AttributeContainer $attrManager
   */
  public function __construct(string $tagName, bool $useCloseTag = false, ?AttributeContainer $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    $this->close = $useCloseTag;
  }

  public function getHtml(): string {
    $output = '<' . $this->getTagName() . $this->attributesToString() . '>';
    if ($this->close) {
      $output .= "</{$this->getTagName()}>";
    }
    return $output;
  }

}
