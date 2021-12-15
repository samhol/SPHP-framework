<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Validators\MessageManager;

class ErrormessageTest extends TestCase {

  public function testConstructor(): MessageManager {
    $errs = new MessageManager();
    $this->assertCount(0, $errs);
    $this->assertEmpty($errs);
    return $errs;
  }

  public function simpleDataSet(): array {
    return array(
        0 => 'foo',
        'zero' => 'foobar',
        'one' => '',
        'two' => 'good job',
    );
  }

  /**
   * @depends testConstructor
   * 
   * @param  MessageManager $errors
   * @return MessageManager
   */
  public function testSettingTemplates(MessageManager $errors): MessageManager {
    $this->assertSame($errors, $errors->setTemplate('foo', '%s is not foo'));
    $this->assertSame($errors, $errors->setTemplate('bar', '%s is not bar'));
    $this->assertSame($errors, $errors->setTemplate('baz', '%s is not baz'));
    $this->assertSame('%s is not foo', $errors->getTemplate('foo'));
    $this->assertSame('%s is not bar', $errors->getTemplate('bar'));
    $this->assertSame('%s is not baz', $errors->getTemplate('baz'));
    return $errors;
  }

  /**
   * @depends testSettingTemplates
   * 
   * @param  MessageManager $errors
   * @return MessageManager
   */
  public function testUsingTemplates(MessageManager $errors): MessageManager {
    $this->assertSame($errors, $errors->appendMessageFromTemplate('foo', 'bar'));
    $this->assertContains('bar is not foo', $errors);
    $this->assertSame('bar is not foo', $errors->getMessage(0));
    $this->assertCount(1, $errors);
    $this->assertSame($errors, $errors->setMessageFromTemplate('bar', 'bar', 'baz'));
    $this->assertContains('baz is not bar', $errors);
    $this->assertSame('baz is not bar', $errors->getMessage('bar'));
    $this->assertSame('foobar is not baz', $errors->buildMessageFromTemplate('baz', 'foobar'));
    $this->assertCount(2, $errors);
    return $errors;
  }

  /**
   * @depends testSettingTemplates
   * 
   * @param MessageManager $messages
   * @return MessageManager
   */
  public function testNesting(MessageManager $messages): MessageManager {
    $messages->setMessage('nest', new MessageManager());
    $messages->getMessage('nest')->setMessage('not-foo', 'Foo is wrong');
    $messages->getMessage('nest')->setMessage('not-bar', 'Bar is wrong');
    $this->assertEquals('Foo is wrong', $messages->getMessage('nest')->getMessage('not-foo'));
    $this->assertCount(4, $messages);
    return $messages;
  }

  /**
   * @depends testNesting
   * 
   * @param MessageManager $messages
   * @return MessageManager
   */
  public function testCount(MessageManager $messages): MessageManager {

    $this->assertCount(4, $messages);
    return $messages;
  }

  /**
   * @depends testNesting
   * @param \Sphp\Validators\MessageManager $messages
   */
  public function testToArray(MessageManager $messages): MessageManager {
    $array = $messages->toArray();
    foreach ($array as $key => $val) {
      $this->assertTrue(is_string($val) || is_array($val));
    }
    $this->assertEquals('Foo is wrong', $messages->getMessage('nest')->getMessage('not-foo'));
    return $messages;
  }

  /**
   * @depends testToArray
   * 
   * @param  MessageManager $messages
   * @return MessageManager
   */
  public function testCloning(MessageManager $messages): MessageManager {
    $clone = clone $messages;
    $this->assertEquals($messages, $clone);
    $this->assertNotSame($messages, $clone);
    $this->assertEquals($messages->getMessage('nest'), $clone->getMessage('nest'));
    $this->assertNotSame($messages->getMessage('nest'), $clone->getMessage('nest'));
    return $messages;
  }

  /**
   * @depends testCloning
   * 
   * @param MessageManager $em
   */
  public function testClearing(MessageManager $em) {

    $this->assertSame($em, $em->unsetMessages());
    $this->assertCount(0, $em);
  }

  /**
   */
  public function testMerging() {
    $cont = new MessageManager();
    $this->assertSame($cont, $cont->mergeCollection($this->simpleDataSet()));
    foreach ($cont as $val) {
      $this->assertTrue(in_array($val, $this->simpleDataSet()));
    }
    $cont->unsetMessages();
    $cont->mergeCollection(new \ArrayObject($this->simpleDataSet()));
    foreach ($cont as $val) {
      $this->assertTrue(in_array($val, $this->simpleDataSet()));
    }
  }

  /**
   * @return array
   */
  public function invalidMergeContent(): array {
    return [
        [new \stdClass()],
        [null],
        [false],
        [true],
        [1],
    ];
  }

  /**
   * @dataProvider invalidMergeContent
   */
  public function testInvalidMerging($mergedData) {
    $cont = new MessageManager();
    $this->expectException(InvalidArgumentException::class);
    $this->assertSame($cont, $cont->mergeCollection([$mergedData]));
  }

  public function testKeyValuePairs() {
    $cont = new MessageManager();
    $items = array(
        0 => 'foo',
        'zero' => 'foobar',
        'one' => '',
        'two' => 'good job',
        'array' => ['a', 'b' => 'c']
    );
    $count = count($items);
    foreach ($items as $offset => $message) {
      $cont->setMessage($offset, $message);
      if (!is_array($message)) {
        $this->assertTrue($cont->containsMessage($offset));
      } else {
        $this->assertEquals($message, $cont->getMessage($offset)->toArray());
      }
    }
    $this->assertSame($count, $cont->count(false));
    // both cycles must pass
    for ($n = 0; $n < 2; ++$n) {
      $i = 0;
      reset($items);
      foreach ($cont as $key => $val) {
        if ($i >= $count) {
          $this->fail("Iterator overflow!");
        }
        $this->assertEquals(key($items), $key);
        //$this->assertEquals(current($items), $val);
        next($items);
        ++$i;
      }
      $this->assertEquals($count, $i);
    }
    foreach ($cont as $key => $value) {
      $cont->removeMessage($key);
      $this->assertFalse($cont->containsMessage($key));
      $this->assertNull($cont->getMessage($key));
    }
  }

  /**
   * @return array
   */
  public function invalidContent(): array {
    return [
        [new \stdClass()],
        [null],
        [false],
        [true],
        [1],
    ];
  }

  /**
   * @dataProvider invalidContent
   * @param mixed $invalidValue
   */
  public function testInvalidInsertion($invalidValue) {
    $cont = new MessageManager();
    $this->expectException(InvalidArgumentException::class);
    $cont->setMessage('foo', $invalidValue);
  }

  public function testAppendingNonExsistentTemplate() {
    $cont = new MessageManager();
    $cont->setTemplate('foo', 'bar');
    $this->expectException(InvalidArgumentException::class);
    $cont->appendMessageFromTemplate('bar');
  }

  /**
   */
  public function testUsageCase() {
    $errors = new MessageManager();
    $errors->setMessage('foo', 'Foo is wrong');
    $errors->setTemplate('bar', 'A bar with %s and %s is wrong');
    $this->assertCount(1, $errors);
    $this->assertEquals('Foo is wrong', $errors->getMessage('foo'));
    $errors->appendMessageFromTemplate('bar', 'foo', 'foobar');
    $this->assertCount(2, $errors);
    $this->assertEquals('A bar with foo and foobar is wrong', $errors->getMessage(0));
    $this->assertSame($errors, $errors->append('Foo is still wrong'));
    $this->assertCount(3, $errors);
    $this->assertEquals('Foo is still wrong', $errors->getMessage(1));
  }

  /**
   */
  public function testFromTraversable() {
    $empty = MessageManager::fromTraversable([]);
    $this->assertCount(0, $empty);
    $one = MessageManager::fromTraversable(['Foo is wrong']);
    $this->assertCount(1, $one);
    $it = MessageManager::fromTraversable(new \ArrayIterator(['Foo is wrong']));
    $this->assertCount(1, $it);
  }

}
