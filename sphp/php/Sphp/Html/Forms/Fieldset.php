<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;fieldset&gt; tag
 *
 * The fieldset element is expected to establish a new block formatting context
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_fieldset.asp w3schools HTML API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-fieldset-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Fieldset extends ContainerTag implements FormController {

  /**
   * the legend of the fieldset component
   *
   * @var Legend
   */
  private $legend;

  /**
   * Constructor
   *
   * @param  string|Legend $legend the legend of the fieldset component
   * @param  mixed $content the content of the component
   */
  public function __construct($legend = null, $content = null) {
    parent::__construct('fieldset', $content);
    //$this->legend = $legend;
    if ($legend !== null) {
      $this->setLegend($legend);
    }
  }

  /**
   * Sets the legend component
   *
   * @param  string|Legend $legend the legend component
   * @return Legend the legend
   */
  public function setLegend($legend): Legend {
    if (!($legend instanceof Legend)) {
      $legend = new Legend($legend);
    }
    $this->legend = $legend;
    return $this->legend;
  }

  /**
   * Returns the legend of the fieldset component
   *
   * @return Legend the legend of the fieldset component or null
   */
  public function getLegend(): Legend {
    return $this->legend;
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->disabled = $disabled;
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

  public function contentToString(): string {
    return $this->legend . parent::contentToString();
  }

}
