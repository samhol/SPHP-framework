<?php

/**
 * ObservableSubjectTrait.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Observers;

use SplObjectStorage;

/**
 * Trait implements the {@link Subject} class in observer pattern
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-01-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   * Notifies all {@link Observer} observers
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
