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

class EventDispatcherTest extends TestCase {

  public function testCreation(): EventDispatcher {
    $singelton1 = EventDispatcher::instance();
    $singelton2 = EventDispatcher::instance();
    $this->assertSame($singelton1, $singelton2);
    return $singelton2;
  }

  /**
   * @depends testCreation
   * @param  EventDispatcher $dispatcher
   * @return EventDispatcher
   */
  public function testAddListener(EventDispatcher $dispatcher): EventDispatcher {
    $order = [];
    $fooListener = $this->getMockBuilder(EventListener::class)->getMock();
    $fooF = function(Event $event) {
      // echo 'Event: ' . $event->getName() . " triggered!\n";
      $this->assertSame('foo', $event->getName());
    };
    $fooListener->expects($this->any())
            ->method('on')
            ->will($this->returnCallback($fooF));
    $listener = $this->getMockBuilder(EventListener::class)->getMock();
    $f = function(Event $event) use (&$order) {
      $order[] = $event;
      // echo 'Event: ' . $event->getName() . " triggered!\n";
      $name = $event->getName();
      $this->assertTrue($name === 'bar' || $name === 'foo' || $name === 'baz');
    };
    $listener->expects($this->any())
            ->method('on')
            ->will($this->returnCallback($f));
    $this->assertFalse($dispatcher->hasListeners('foo'));
    $this->assertEmpty($dispatcher->getListeners('foo'));

    $this->assertSame($dispatcher, $dispatcher->addListener('foo', $fooListener));
    $this->assertTrue($dispatcher->hasListeners('foo'));
    $this->assertSame($fooListener, $dispatcher->getListeners('foo')[0]);

    $this->assertSame($dispatcher, $dispatcher->addListener('foo', $listener));
    $this->assertEmpty($dispatcher->getListeners('bar'));
    $this->assertSame($dispatcher, $dispatcher->addListener('bar', $listener));
    $this->assertSame($dispatcher, $dispatcher->addListener('baz', $listener));
    $this->assertTrue($dispatcher->hasListeners('bar'));
    return $dispatcher;
  }

  public function testPriority() {
    $order = [];
    $f1 = function() use (&$order) {
      $order[] = 'f1';
    };
    $f10 = function() use (&$order) {
      $order[] = 'f10';
    };
    $f100_1 = function() use (&$order) {
      $order[] = 'f100_1';
    };
    $f100_2 = function() use (&$order) {
      $order[] = 'f100_2';
    };

    $dispatcher = new EventDispatcher();
    $dispatcher->addListener('foo', $f1, 1);
    $dispatcher->addListener('foo', $f100_1, 100);
    $dispatcher->addListener('foo', $f10, 10);
    $dispatcher->addListener('foo', $f100_2, 100);
    $dispatcher->triggerDataEvent('foo', 'foo', ['1']);
    $this->assertEquals(['f100_1', 'f100_2', 'f10', 'f1'], $order);
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
    $event1 = $dispatcher->triggerDataEvent('bar', $this, $data);
    $dispatcher->trigger(new DataEvent('baz'));
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
    $this->assertTrue($dispatcher->hasListeners('foo'));
    $this->assertSame($dispatcher, $dispatcher->removeListenersOf('foo'));
    $this->assertFalse($dispatcher->hasListeners('foo'));
    $this->assertSame($dispatcher, $dispatcher->removeListenersOf('bar'));
    $this->assertFalse($dispatcher->hasListeners('bar'));
    $this->assertSame($dispatcher, $dispatcher->removeListenersOf('baz'));
    $this->assertFalse($dispatcher->hasListeners('baz'));
    $dispatcher->addListener('foobar', $f = function () {
      
    });
    $this->assertTrue($dispatcher->hasListeners('foobar'));
    $dispatcher->addListener('bar', $f);
    $dispatcher->addListener('baz', $f);
    $this->assertSame($dispatcher, $dispatcher->removeListener($f, 'baz'));
    $this->assertFalse($dispatcher->hasListeners('baz'));
    $this->assertSame($dispatcher, $dispatcher->removeListener($f));
    /* $this->assertTrue($dispatcher->hasListeners('bar'));
      $this->assertSame($dispatcher, $dispatcher->remove($this));
      $this->assertSame($dispatcher, $dispatcher->remove($this->listenerFunction()));
      $dispatcher->removeListenersOf('foo');
      $this->assertFalse($dispatcher->hasListeners('foo'));
      $this->assertFalse($dispatcher->hasListeners('bar'));
      //$this->assertFalse($dispatcher->hasListeners('baz')); */
  }

}
