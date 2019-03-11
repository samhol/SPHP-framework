<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Adapters\AbstractComponentAdapter;
use Sphp\Html\Component;

/**
 * Description of Toggler
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VisibilityToggleController extends AbstractComponentAdapter {

  /**
   * @var string[] 
   */
  private $ids;

  /**
   * Constructor
   * 
   * @param Component $equalizer
   */
  public function __construct(Component $equalizer) {
    parent::__construct($equalizer);
    $this->ids = [];
  }

  /**
   * 
   * @param  Component $target
   * @param  string $animation
   * @return $this for a fluent interface
   */
  public function addToggler(Component $target, string $animation) {
    if ($animation === null) {
      $animation = true;
    }
    if (!$target instanceof VisibilityToggler) {
      $target->setAttribute('data-toggler', true);
      $target->setAttribute('data-animate', $animation);
    }
    $id = $target->identify();
    if (!in_array($id, $this->ids)) {
      $this->ids[] = $id;
      $this->attributes()->setAttribute('data-toggle', implode(' ', $this->ids));
    }
    return $this;
  }

}
