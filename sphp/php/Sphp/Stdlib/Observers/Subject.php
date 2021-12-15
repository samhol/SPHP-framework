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
 * Defines the subject part of the Observer Design Pattern
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Subject {

  /**
   * Attach an observer to the observable
   *
   * @param  Observer|callable $o the attached observer
   * @return void
   */
  public function attach(Observer $o): void;

  public function contains(Observer $o): bool;


  /**
   * Detaches an observer from the observable
   *
   * @param  Observer|callable $o the detached observer
   * @return void
   */
  public function detach(Observer $o): void;

  /**
   * Notifies all observers
   */
  public function notify(): void;
}
