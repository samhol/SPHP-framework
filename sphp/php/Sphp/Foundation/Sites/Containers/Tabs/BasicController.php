<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Containers\Tabs;

use Sphp\Html\ContainerTag;
use Sphp\Html\ContainerTag;

/**
 * Implements a Tab controller for Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BasicController extends ContainerTag implements TabController {

  /**
   * Constructor
   * 
   * @param mixed $title
   * @param mixed $target
   */
  public function __construct($title, $target) {
    $innerContainer = new ContainerTag('a', $title);
    if ($target instanceof \Sphp\Html\Component) {
      $id = $target->identify();
    } else if (is_string($target)) {
      $id = $target;
    } else {
      throw new InvalidArgumentException('Invalid targettype given');
    }
    $innerContainer->attributes()->protect('href', "#$id");
    parent::__construct('li', null, $innerContainer);
    $this->cssClasses()->protectValue('tabs-title');
  }

  public function setActive(bool $active = true) {
    if ($active) {
      $this->attributes()->setAria('aria-selected', 'true');
      $this->addCssClass('is-active');
    } else {
      $this->attributes()->remove('aria-selected');
      $this->removeCssClass('is-active');
    }
    return $this;
  }

}
