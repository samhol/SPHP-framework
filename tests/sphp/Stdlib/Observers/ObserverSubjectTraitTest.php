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

class ObserverSubjectTraitTest extends TestCase {

  /**
   * @var ObservableSubjectTrait
   */
  protected $subject;
  protected $observer;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->appendedStrings = [];
    $f = function($subject) {
      $this->appendedStrings[] = $subject;
      $this->assertSame($this->subject, $subject);
    };
    $this->subject = $this->getMockForTrait(ObservableSubjectTrait::class);
    $this->observer = $this->createMock(Observer::class);

    // Configure the stub.
    $this->observer->method('update')
            ->will($this->returnCallback($f));
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->subject, $this->observer);
  }

  public function testObserving() {
    $this->assertFalse($this->subject->contains($this->observer));
    $this->subject->attach($this->observer);
    $this->assertTrue($this->subject->contains($this->observer));
    $this->subject->notify();
    $this->assertSame($this->subject->detach($this->observer));
    $this->assertFalse($this->subject->contains($this->observer));
  }

}
