<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Observers;

use SplObjectStorage;

/**
 * Trait implements the {@link Subject} class in observer pattern
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait ObservableSubjectTrait {

  /**
   * collection of individual observer objects
   *
   * @var SplObjectStorage
   */
  protected $observers;

  /**
   * Attach an observer to the observable
   *
   * @param Observer|callable $obs the attached observer
   */
  public function attach($obs) {
    if ($this->observers === null) {
      $this->observers = new SplObjectStorage();
    }
    $this->observers->attach($obs);
  }

  /**
   * Detaches an observer from the observable
   *
   * @param Observer|callable $obs the detached observer
   */
  public function detach($obs) {
    $this->observers->detach($obs);
  }

  /**
   * Notifies all observers
   */
  public function notify() {
    if ($this->observers !== null) {
      foreach ($this->observers as $obs) {
        if ($obs instanceof Observer) {
          $obs->update($this);
        } else if (is_callable($obs)) {
          $obs($this);
        }
      }
    }
  }

}
