<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Form;

/**
 * Description of FormTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FormTest extends TestCase {

  public function testEmptyConstructor(): Form {
    $form = new Form();
    $this->assertNull($form->getAction());
    $this->assertNull($form->getMethod());
    $this->assertNull($form->getName());
    $this->assertNull($form->getTarget());
    $this->assertNull($form->getEnctype());
    return $form;
  }

  public function constructorData(): iterable {
    yield ['foo/bar', 'get', 'foo'];
    yield ['foo/bar', 'post', 'foo'];
    yield [null, 'post', 'foo'];
    yield [null, 'post', null];
    yield ['foo/bar', null, 'foo'];
  }

  /**
   * @dataProvider constructorData
   * 
   * @param  string|null $action
   * @param  string|null $method
   * @param  mixed $content
   * @return void
   */
  public function testConstructor(?string $action = null, ?string $method = null, mixed $content = null): void {
    $form = new Form($action, $method, $content);
    $this->assertSame($action, $form->getAction());
    $this->assertSame($method, $form->getMethod());
    $this->assertSame((string) $content, $form->contentToString());
    $this->assertNull($form->getTarget());
    $this->assertNull($form->getEnctype());
  }

  /**
   * @depends testEmptyConstructor
   * 
   * @param   Form $form
   * @return  Form
   */
  public function testAttributeManipulation(Form $form): Form {
    $this->assertSame($form, $form->setAction('/foo/bar'));
    $this->assertSame('/foo/bar', $form->getAction());
    $this->assertSame($form, $form->setMethod('get'));
    $this->assertSame('get', $form->getMethod());
    $this->assertSame($form, $form->setName('foo-form'));
    $this->assertSame('foo-form', $form->getName());
    $this->assertSame($form, $form->setTarget('_blank'));
    $this->assertSame('_blank', $form->getTarget());
    $this->assertSame($form, $form->setEnctype('text/plain'));
    $this->assertSame('text/plain', $form->getEnctype());
    $this->assertSame($form, $form->autocomplete(true));
    return $form;
  }

  /**
   * @depends testAttributeManipulation
   * 
   * @param   Form $form
   * @return  Form
   */
  public function testUseValidation(Form $form): Form {
    $this->assertFalse($form->attributes()->isVisible('novalidate'));
    $this->assertSame($form, $form->useValidation(true));
    $this->assertFalse($form->attributes()->isVisible('novalidate'));
    $this->assertSame($form, $form->useValidation(false));
    $this->assertTrue($form->attributes()->isVisible('novalidate'));
    return $form;
  }

  /**
   * @depends testEmptyConstructor
   * @param Form $form
   * @return void
   */
  public function testgetInputs(Form $form): void {
    $form->appendStrong('strong text');
    $hiddenInput = $form->appendHiddenInput('hidden1', 'hidden-value1');
    $this->assertCount(2, $form);
    $this->assertCount(1, $form->getNamedInputComponents());
  }

}
