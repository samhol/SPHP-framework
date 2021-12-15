<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Observers;

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
   * @var Observer[]
   */
  private array $observers = [];

  /**
   * Attach an observer to the observable
   *
   * @param  Observer|callable $o the attached observer
   * @return void
   */
  public function attach(Observer $o): void {
    if (!$this->contains($o)) {
      $this->observers[] = $o;
    }
  }

  /**
   * 
   * @param  Observer $o the observer
   * @return bool
   */
  public function contains(Observer $o): bool {
    return in_array($o, $this->observers, true);
  }

  /**
   * Detaches an observer from the observable
   *
   * @param  Observer|callable $o the detached observer
   * @return void
   */
  public function detach(Observer $o): void {
    $key = array_search($o, $this->observers, true);
    if ($key !== false) {
      unset($this->observers[$key]);
    }
  }

  /**
   * Notifies all observers
   * 
   * @return void
   */
  public function notify(): void {
    foreach ($this->observers as $obs) {
      $obs->update($this);
    }
  }

}
