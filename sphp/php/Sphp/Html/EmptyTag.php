<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;
use Sphp\Html\Attributes\HtmlAttributeManager;
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

  /**
   * @var bool
   */
  private $close = false;

  /**
   * Constructor
   * 
   * @param string $tagName
   * @param bool $useCloseTag
   * @param HtmlAttributeManager $attrManager
   */
  public function __construct(string $tagName, bool $useCloseTag = false, HtmlAttributeManager $attrManager = null) {
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
