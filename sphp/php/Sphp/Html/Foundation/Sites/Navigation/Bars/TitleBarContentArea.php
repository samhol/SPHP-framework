<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Bars;

use Sphp\Html\PlainContainer;
use Sphp\Html\Span;

/**
 * Implements a Title Bar content area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TitleBarContentArea extends AbstractBarContentArea {

  /**
   * Constructor
   *
   * @precondition $side == 'left' | 'right'
   * @param string $side the side of the container
   */
  public function __construct(string $side) {
    parent::__construct('div');
    $this->cssClasses()->protectValue("title-bar-$side");
  }

  /**
   * Sets the title of the Title Bar area component
   *
   * @param  mixed $title the title of the Title Bar area component
   * @return $this for a fluent interface
   */
  public function prependTitle($title) {
    $component = new Span($title);
    $component->cssClasses()->protectValue('title-bar-title');
    $this->prepend($component);
    return $this;
  }
  /**
   * Sets the title of the Title Bar area component
   *
   * @param  mixed $title the title of the Title Bar area component
   * @return $this for a fluent interface
   */
  public function appendTitle($title) {
    $component = new Span($title);
    $component->cssClasses()->protectValue('title-bar-title');
    $this->append($component);
    return $this;
  }

}
