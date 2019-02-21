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
class Toggler extends AbstractComponentAdapter {

  /**
   * @var string[] 
   */
  private $ids;

  /**
   * Constructor
   * 
   * @param Component $equalizer
   * @param string|null $name
   */
  public function __construct(Component $equalizer) {
    parent::__construct($equalizer);
    $this->ids = [];
  }

  /**
   * 
   * @param  Component $target
   * @param  string $animation
   * @return $this
   */
  public function addTarget(Component $target, string $animation = null) {
    if ($animation === null) {
      $animation = true;
    }
    $target->setAttribute('data-toggler', true);
    $target->setAttribute('data-animate', $animation);
    $id = $target->identify();
    if (!in_array($id, $this->ids)) {
      $this->ids[] = $id;
      $this->attributes()->setAttribute('data-toggle', implode(' ', $this->ids));
    }
    return $this;
  }

}
