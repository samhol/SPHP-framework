<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs\Sliders;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Span;

/**
 * Description of ValueViewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ValueRangeViewer extends AbstractComponent {

  /**
   * @var Input 
   */
  private $minViewer;

  /**
   * @var Input 
   */
  private $maxViewer;

  public function __construct(Input $minInput, Input $maxInput) {
    parent::__construct('span');
    $this->minViewer = new Span;
    $this->maxViewer = new Span;
    $this->minViewer->setAttribute('data-min', $minInput->identify());
    $this->minViewer->resetContent($minInput->getSubmitValue());
    $this->maxViewer->setAttribute('data-max', $maxInput->identify());
    $this->maxViewer->resetContent($maxInput->getSubmitValue());
  }

  public function __destruct() {
    unset($this->minViewer, $this->maxViewer);
    parent::__destruct();
  }

  public function contentToString(): string {
    return $this->minViewer->getHtml() . '-' . $this->maxViewer->getHtml();
  }

}
