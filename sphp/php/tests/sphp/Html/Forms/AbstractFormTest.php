<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Forms;

use PHPUnit\Framework\TestCase;

/**
 * Description of AbstractFormTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractFormTest extends TestCase {

  public function testConstructor(): AbstractForm {
    $Hidden = new Inputs\HiddenInputs;
    $form = $this->getMockForAbstractClass(AbstractForm::class, [$Hidden]);
    $form->expects($this->any())
            ->method('contentToString')
            ->will($this->returnValue((string) $Hidden));
    // $this->expectOutputString($Hidden->getHtml());
    //$mock->printHtml();
    $this->assertNull($form->getAction());
    $this->assertNull($form->getMethod());
    $this->assertNull($form->getName());
    $this->assertNull($form->getTarget());
    $this->assertNull($form->getEnctype());
    return $form;
  }

  /**
   * @depends testConstructor
   * @param   AbstractForm $form
   * @return  AbstractForm
   */
  public function testAttributeManipulation(AbstractForm $form): AbstractForm {
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
   * @param   AbstractForm $form
   * @return  AbstractForm
   */
  public function testUseValidation(AbstractForm $form): AbstractForm {
    $this->assertFalse($form->attributes()->isVisible('novalidate'));
    $this->assertSame($form, $form->useValidation(true));
    $this->assertFalse($form->attributes()->isVisible('novalidate'));
    $this->assertSame($form, $form->useValidation(false));
    $this->assertTrue($form->attributes()->isVisible('novalidate'));
    return $form;
  }

}
