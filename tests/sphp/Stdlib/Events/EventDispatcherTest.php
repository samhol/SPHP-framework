<?php

namespace Sphp\Stdlib\Events;

class EventDispatcherTest extends \PHPUnit\Framework\TestCase implements EventListener {

  /**
   * @var EventDispatcher
   */
  protected $eventDispacher;

  /**
   * @var \Closure
   */
  protected $function;

  /**
   * @var DataEvent
   */
  protected $dataEvent;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->eventDispacher = new EventDispatcher();
    $this->function = function ($event) {
      $this->assertInstanceOf(Event::class, $event);
    };
    $this->dataEvent = new DataEvent('DataEvent', $this, ['foo', new \stdClass()]);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->eventDispacher, $this->function, $this->dataEvent);
  }

  public function testAdding(): EventDispatcher {
    $eventDispacher = EventDispatcher::instance();
    $eventDispacher->addListener($this->dataEvent, $this->function);
    $this->assertTrue($eventDispacher->hasListeners($this->dataEvent));
    $eventDispacher->triggerEvent($this->dataEvent);
    return $eventDispacher;
  }

  /**
   * 
   * @depends testAdding
   * @param \Sphp\Stdlib\Events\EventDispatcher $eventDispacher
   * @return \Sphp\Stdlib\Events\EventDispatcher
   */
  public function testTriggering(EventDispatcher $eventDispacher): EventDispatcher {
    $eventDispacher->triggerEvent('event1');
    $this->assertTrue($eventDispacher->hasListeners($this->dataEvent));
    return $eventDispacher;
  }

  public function testA() {
    $this->eventDispacher->addListener('evt', function($evt) {
      //echo "$evt\n";
      $this->assertSame('evt', $evt->getName());
    });
    $this->assertTrue($this->eventDispacher->hasListeners('evt'));
    $this->assertTrue($this->eventDispacher->hasListeners('evt'));
    $this->eventDispacher->triggerEvent('evt');
  }

  /**
   */
  public function test1() {
    $this->assertFalse($this->eventDispacher->hasListeners("e1"));
    $this->eventDispacher->addListener("DataEvent", $this->function);
    $this->assertTrue($this->eventDispacher->hasListeners("DataEvent"));
    $this->assertFalse($this->eventDispacher->hasListeners("b"));
    $this->eventDispacher->addListener(["a", "b"], $this);
    $this->assertTrue($this->eventDispacher->hasListeners("a"));
    $this->assertTrue($this->eventDispacher->hasListeners("b"));
    $this->eventDispacher->trigger($this->dataEvent);
  }

  public function on(Event $event) {
    $this->assertFalse($event->isStopped());
  }

}
