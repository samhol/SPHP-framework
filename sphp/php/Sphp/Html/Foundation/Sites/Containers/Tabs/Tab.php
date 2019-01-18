<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\AbstractContainerTag;

/**
 * Implements a Tab for Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Tab extends AbstractContainerTag implements TabInterface {

  /**
   *
   * @var TabController 
   */
  private $tabButton;

  /**
   * Constructor
   * 
   * @param mixed $tab the tab button content
   * @param type $content the tab content
   */
  public function __construct($tab = null, $content = null) {
    parent::__construct('div');
    $this->identify();
    $this->cssClasses()->protectValue("tabs-panel");
    if ($content !== null) {
      $this->append($content);
    }
    $this->tabButton = new TabController($this, $tab);
  }

  /**
   * 
   * @return TabController
   */
  public function getTabButton() {
    return $this->tabButton;
  }

  public function setActive(bool $visibility = true) {
    if ($visibility) {
      $this->addCssClass('is-active');
    } else {
      $this->removeCssClass('is-active');
    }
    $this->tabButton->setActive($visibility);
    return $this;
  }

}
