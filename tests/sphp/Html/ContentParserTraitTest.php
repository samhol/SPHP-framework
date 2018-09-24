<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use PHPUnit\Framework\TestCase;

class ContentParserTraitTest extends TestCase {

  /**
   * @var ContentParsingTrait
   */
  protected $contentParser;


  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->contentParser = $this->getMockForTrait(ContentParsingTrait::class);
    $this->contentParser->expects($this->any())
            ->method('append')
             ->will($this->returnArgument(0));
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->contentParser);
    parent::tearDown();
  }
  public function testConcreteMethod() {
    $contentParser = $this->getMockForTrait(ContentParsingTrait::class)
                         ->getMock();
    $contentParser
            ->expects($this->once())
            ->method('append')
             ->with($this->callback(function($subject){
               $this->assertTrue(is_string($subject));
                          return is_callable([$subject, 'getName']) &&
                                 $subject->getName() == 'My subject';
                          
                        }));
     $this->contentParser->appendMd('# foo');
  }

}
