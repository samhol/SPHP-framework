<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\MessageManager;

class MessageManagerTest extends TestCase {

  public const TEMPLATE_1 = ':value is not foo';
  public const TEMPLATE_2 = ':value is not bar';

  public function testConstructor(): MessageManager {
    $msgManager = new MessageManager();
    $this->assertCount(0, $msgManager);
    $this->assertEmpty($msgManager->toArray());
    $this->assertCount(0, $msgManager->getIterator());
    return $msgManager;
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
   * @param  MessageManager $msgManager
   * @return MessageManager
   */
  public function testSettingTemplates(MessageManager $msgManager): MessageManager {
    $templates = [
        't1' => self::TEMPLATE_1,
        't2' => self::TEMPLATE_2,
            ];
    $this->assertSame($msgManager, $msgManager->setTemplate('t1', self::TEMPLATE_1));
    $this->assertSame($msgManager, $msgManager->setTemplate('t2', self::TEMPLATE_2));
    $this->assertTrue($msgManager->containsTemplate('t1'));
    $this->assertTrue($msgManager->containsTemplate('t2'));
    $this->assertSame(self::TEMPLATE_1, $msgManager->getTemplate('t1'));
    $this->assertSame(self::TEMPLATE_2, $msgManager->getTemplate('t2'));
    $this->assertSame($templates, $msgManager->getTemplates());
    
    return $msgManager;
  }

  /**
   * @depends testSettingTemplates
   * 
   * @param  MessageManager $errors
   * @return MessageManager
   */
  public function testUsingTemplates(MessageManager $errors): MessageManager {
    $this->assertSame($errors, $errors->appendMessageFromTemplate('t1', [':value' => 'bar']));
    $this->assertContains('bar is not foo', $errors);
    $this->assertSame('bar is not foo', $errors->getMessages(0));
    $this->assertCount(1, $errors);
    $this->assertSame($errors, $errors->setMessageFromTemplate('t2', [':value' => 'baz']));
    $this->assertContains('baz is not bar', $errors);
    $this->assertSame('baz is not bar', $errors->getMessages('t2'));
    $this->assertSame('foobar is not bar', $errors->buildMessageFromTemplate('t2', [':value' => 'foobar']));
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
    $clone = clone $messages;
    $messages->setMessages('nest', $clone);
    $this->assertSame($clone, $messages->getMessages('nest'));
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
    //$this->assertEquals('Foo is wrong', $messages->getMessages('nest')['not-foo']);
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
    $this->assertNotSame($messages->getMessages('nest'), $clone->getMessages('nest'));
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

  public function testKeyValuePairs(): void {
    $msgMngr = new MessageManager();

    $msgMngr->setMessages(1, 'first');
    $this->assertTrue($msgMngr->containsMessage(1));
    $this->assertSame('first', $msgMngr->getMessages(1));
    $this->assertCount(1, $msgMngr);

    $msgMngr->setMessages('string', 'second');
    $this->assertTrue($msgMngr->containsMessage('string'));
    $this->assertSame('second', $msgMngr->getMessages('string'));
    $this->assertCount(2, $msgMngr);

    $msgMngr->setMessages(null, 'third');
    $this->assertTrue($msgMngr->containsMessage(2));
    $this->assertSame('third', $msgMngr->getMessages(2));
    $this->assertCount(3, $msgMngr);
  }

  public function testAppendingNonExsistentTemplate(): void {
    $cont = new MessageManager();
    $cont->setTemplate('t1', 'bar');
    $this->expectException(InvalidArgumentException::class);
    $cont->appendMessageFromTemplate('t2');
  }

  /**
   */
  public function testUsageCase() {
    $errors = new MessageManager();
    $errors->setMessages('m1', 'message1');
    $errors->setTemplate('t1', ':a is not :b');
    $this->assertCount(1, $errors);
    $this->assertEquals('message1', $errors->getMessages('m1'));
    $errors->setMessageFromTemplate('t1', [':a' => 'foo', ':b' => 'foobar']);
    $this->assertCount(2, $errors);
    $this->assertEquals('foo is not foobar', $errors->getMessages('t1'));
    $this->assertSame($errors, $errors->append('Foo is still wrong'));
    $this->assertCount(3, $errors);
    $this->assertEquals('Foo is still wrong', $errors->getMessages(0));
  }

}
