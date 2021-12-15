<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Sections;

/**
 * Implementation of an HTML blockquote tag
 *
 *  This component defines a section that is quoted from another source.
 * 
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_aside.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Blockquote extends AbstractFlowContainer {

  /**
   * Constructor
   * 
   * @param  mixed $content optional content of the component
   * @param  string $cite Specifies the source of the quotation
   */
  public function __construct($content = null, string $cite = null) {
    parent::__construct('blockquote', $content);
    if ($cite !== null) {

      $this->setCite($cite);
    }
  }

  /**
   * Sets the source of the quotation
   * 
   * @param  string $cite Specifies the source of the quotation
   * @return $this for a fluent interface
   */
  public function setCite(string $cite = null) {
    $this->setAttribute('cite', $cite);
    return $this;
  }

}
