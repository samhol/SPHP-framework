<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Accordions;

use Sphp\Html\Content;
use Sphp\Html\ContainerComponent;

/**
 * Defines a Pane for Foundation Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Pane extends Content {

  /**
   * Sets the title of the accordion pane
   *
   * @param  mixed $title the heading content
   * @return $this for a fluent interface
   */
  public function setPaneTitle($title);

  /**
   * Sets the visibility of the content after initialization
   *
   * @param  bool $visibility true if the content is visible, false otherwise
   * @return $this for a fluent interface
   */
  public function contentVisible(bool $visibility = true);

  /**
   * Returns the inner title area of the accordion pane
   *
   * @return ContainerComponent the inner title area of the accordion pane
   */
  public function getBar(): ContainerComponent;

  /**
   * Returns the inner content area of the accordion pane
   *
   * @return ContainerComponent the inner content area of the accordion pane
   */
  public function getContent(): ContainerComponent;
}
