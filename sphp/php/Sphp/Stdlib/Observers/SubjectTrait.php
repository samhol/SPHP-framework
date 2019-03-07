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
 * Trait implements Subject interface in observer pattern
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait SubjectTrait {

  /**
   * collection of individual observer objects
   *
   * @var SplObjectStorage
   */
  private $observers;

  /**
   * Attach an observer to the observable
   *
   * @param  Observer|callable $obs the attached observer
   * @return void
   */
  public function attach($obs): void {
    if ($this->observers === null) {
      $this->observers = new SplObjectStorage();
    }
    $this->observers->attach($obs);
    //var_dump($this->observers, $obs);
  }

  public function contains($observer): bool {
    if ($this->observers === null) {
      $this->observers = new SplObjectStorage();
    }
    return $this->observers->contains($observer);
  }

  /**
   * Detaches an observer from the observable
   *
   * @param  Observer|callable $obs the detached observer
   * @return void
   */
  public function detach($obs): void {
    $this->observers->detach($obs);
  }

  /**
   * Notifies all observers
   * 
   * @return void
   */
  public function notify(): void {
    if ($this->observers !== null) {
      foreach ($this->observers as $obs) {
        if ($obs instanceof Observer) {
          $obs->update($this);
        } else {
          $obs($this);
        }
      }
    }
  }

}
