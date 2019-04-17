<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Observers;

use PHPUnit\Framework\TestCase;
use Eloquent\Phony\Phony;

class ObserverSubjectTraitTest  {

  /**
   * @var ObservableSubjectTrait
   */
  protected $subject;
  protected $observer;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->appendedStrings = [];
    $this->subject = Phony::mock([Subject::class, ObservableSubjectTrait::class]);

    $this->observer = Phony::mock(Observer::class);
    //$this->observer->update->returns($this->subject);
    // $this->observer->update->calledWith($this->subject);
    // Configure the stub.
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->subject, $this->observer);
  }

  public function testObserving() {
    $subject = $this->subject->get();
    $o = $this->observer->get();
    $this->assertFalse($subject->contains($o));
    $subject->attach($o);
    $this->assertTrue($subject->contains($o));
    $subject->notify();
    $this->observer->update->calledWith($subject);
    $this->assertSame($subject->detach($o));
    $this->assertFalse($subject->contains($o));
  }

}
