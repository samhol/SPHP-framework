<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag;

/**
 * fieldset tag
 *
 * The fieldset element is expected to establish a new block formatting context
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_fieldset.asp w3schools HTML API
 * @link    https://www.w3.org/html/wg/drafts/html/master/forms.html#the-fieldset-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Fieldset extends ContainerTag implements FormController {

  private ?Legend $legend = null;

  /**
   * Constructor
   *
   * @param  mixed $content the content of the component
   * @param  string|Legend $legend the legend of the fieldset component
   */
  public function __construct(mixed $content = null, string|Legend|null $legend = null, ) {
    parent::__construct('fieldset', $content);
    //$this->legend = $legend;
    if ($legend !== null) {
      $this->setLegend($legend);
    }
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->legend);
  }

  /**
   * Sets the legend component
   *
   * @param  string|Legend|null $legend the legend component
   * @return Legend the legend
   */
  public function setLegend(string|Legend|null $legend): ?Legend {
    if ($legend !== null && !$legend instanceof Legend) {
      $legend = new Legend($legend);
    }
    $this->legend = $legend;
    return $this->legend;
  }

  /**
   * Returns the legend of the fieldset component
   *
   * @return Legend|null the legend of the fieldset component or null
   */
  public function getLegend(): ?Legend {
    return $this->legend;
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->setAttribute('disabled', $disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

  public function contentToString(): string {
    return $this->getLegend() . parent::contentToString();
  }

}
