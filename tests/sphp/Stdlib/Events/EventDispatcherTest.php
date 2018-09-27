<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Events;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;

class EventDispatcherTest extends TestCase implements EventListener {

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
  protected $callCounter = [];

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->eventDispacher = new EventDispatcher();

    $this->dataEvent = new DataEvent('DataEvent', $this, ['foo', new \stdClass()]);
  }

  public function listenerFunction() {
    if (!is_callable($this->function)) {
      $this->function = function ($event) {
        $this->addCall($event);
        $this->assertInstanceOf(Event::class, $event);
      };
    } return $this->function;
  }

  protected function addCall(Event $event) {
    if (!array_key_exists($event->getName(), $this->callCounter)) {
      $this->callCounter[$event->getName()] = 1;
    } else {
      $this->callCounter[$event->getName()] += 1;
    }
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->eventDispacher, $this->function, $this->dataEvent);
  }

  public function on(Event $event) {
    $this->assertFalse($event->isStopped());
    $this->addCall($event);
  }

  public function testCreation(): EventDispatcher {
    $dispatcher = new EventDispatcher();
    $singelton = EventDispatcher::instance($dispatcher);
    $this->assertSame($dispatcher, $singelton);
    return $singelton;
  }

  /**
   * @depends testCreation
   * @param  EventDispatcher $dispatcher
   * @return EventDispatcher
   */
  public function testAddListener(EventDispatcher $dispatcher): EventDispatcher {
    $l = $this->getMockBuilder(EventListener::class)
            ->getMock();
    $f = function($subject) {
      $this->appendedStrings[] = $subject;
      //$this->assertTrue(is_string($subject));
    };
    $l->expects($this->any())
            ->method('on')
            ->will($this->returnCallback($f));
    $this->assertFalse($dispatcher->hasListeners('foo'));
    $this->assertEmpty($dispatcher->getListeners('foo'));
    $this->assertSame($dispatcher, $dispatcher->addListener('foo', $this));
    $this->assertTrue($dispatcher->hasListeners('foo'));
    $this->assertSame($this, $dispatcher->getListeners('foo')[0]);
    $this->assertEmpty($dispatcher->getListeners('bar'));
    $this->assertSame($dispatcher, $dispatcher->addListener('bar', $this->listenerFunction()));
    $this->assertTrue($dispatcher->hasListeners('bar'));
    $this->assertSame($this->listenerFunction(), $dispatcher->getListeners('bar')[0]);
    return $dispatcher;
  }

  public function testAddInvalidListener() {
    $dispatcher = new EventDispatcher();
    $this->expectException(InvalidArgumentException::class);
    $dispatcher->addListener('err', new \stdClass());
  }

  /**
   * @depends testAddListener
   * @param  EventDispatcher $dispatcher
   * @return EventDispatcher
   */
  public function testEventTriggering(EventDispatcher $dispatcher): EventDispatcher {
    $data = ['foo-data'];
    $event = $dispatcher->triggerDataEvent('foo', $this, $data);
    $this->assertSame('foo', $event->getName());
    $this->assertSame($this, $event->getSubject());
    $this->assertSame($data, $event->getData());

    //$this->assertSame(1, $this->callCounter['foo']);
    return $dispatcher;
  }

  /**
   * @depends testEventTriggering
   * @param  EventDispatcher $dispatcher
   * @return EventDispatcher
   */
  public function testListenerRemoving(EventDispatcher $dispatcher) {
    $this->assertSame($dispatcher, $dispatcher->addListener('bar', $this));
    $this->assertSame($dispatcher, $dispatcher->addListener('baz', $this));
    $this->assertSame($dispatcher, $dispatcher->remove($this, 'baz'));
    $this->assertFalse($dispatcher->hasListeners('baz'));
    $this->assertTrue($dispatcher->hasListeners('bar'));
    $this->assertSame($dispatcher, $dispatcher->remove($this));
    $this->assertSame($dispatcher, $dispatcher->remove($this->listenerFunction()));
    //$this->assertFalse($dispatcher->hasListeners('foo'));
    //$this->assertFalse($dispatcher->hasListeners('bar'));
    //$this->assertFalse($dispatcher->hasListeners('baz'));
  }

}
