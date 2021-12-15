<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\EventDispatcher\Dispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Class EventDispatcher
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
final class Dispatcher implements EventDispatcherInterface {

  private ListenerProviderInterface $listenerProvider;

  public function __construct(ListenerProviderInterface $listenerProvider) {
    $this->listenerProvider = $listenerProvider;
  }

  public function __destruct() {
    unset($this->listenerProvider);
  }

  public function dispatch(object $event): object {
    /** @var callable $listener */
    foreach ($this->listenerProvider->getListenersForEvent($event) as $listener) {
      if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
        return $event;
      }
      $spoofableEvent = $event;
      $listener($spoofableEvent);
    }
    return $event;
  }

}
