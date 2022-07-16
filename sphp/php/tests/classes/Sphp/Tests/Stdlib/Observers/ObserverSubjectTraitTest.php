<?php

declare(strict_types=1);


/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Observers;

use PHPUnit\Framework\TestCase;
use \Sphp\Stdlib\Observers\SubjectTrait;
use Sphp\Stdlib\Observers\Subject;
use Sphp\Stdlib\Observers\Observer;

class ObserverSubjectTraitTest extends TestCase {

  /**
   * @var SubjectTrait
   */
  protected Subject $subject;
  protected Observer $observer;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->subject = new class implements Subject {

      use SubjectTrait;
    };

    $this->getMockForTrait(SubjectTrait::class);

    $this->observer = new class($this->subject) implements Observer {

      private Subject $expected;

      public function __construct(Subject $expected) {
        $this->expected = $expected;
      }

      public function update(Subject $subject): void {
        \PHPUnit\Framework\Assert::assertSame($this->expected, $subject);
      }
    };
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->subject, $this->observer);
  }

  public function testObserving(): void {
    $this->assertFalse($this->subject->contains($this->observer));
    $this->subject->attach($this->observer);
    $this->assertTrue($this->subject->contains($this->observer));
    $this->subject->notify();
    $this->subject->detach($this->observer);
    $this->assertFalse($this->subject->contains($this->observer));
  }

}
