<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Attributes\PropertyCollectionAttribute;

/**
 * Description of DrlilldownMenu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DrlilldownMenu extends AbstractMenu {

  /**
   * @var PropertyCollectionAttribute 
   */
  private $options;

  public function __construct() {
    parent::__construct();

    $this->cssClasses()->protectValue('drilldown');
    $this->setVertical(true);
    $this->attributes()->protect('data-drilldown', true);
    $this->attributes()->setInstance($this->options = new PropertyCollectionAttribute('data-options'));
  }

  /**
   * 
   * @param bool $auto
   * @param bool $animate
   * @return $this
   */
  public function useAutoHeight(bool $auto = true, bool $animate = true) {
    $this->options->setProperty('autoHeight', $auto ? 'true' : 'false');
    if ($auto) {
      $this->options->setProperty('animateHeight', $animate ? 'true' : 'false');
    } else {
      $this->options->unsetProperty('animateHeight');
    }
    return $this;
  }

}
