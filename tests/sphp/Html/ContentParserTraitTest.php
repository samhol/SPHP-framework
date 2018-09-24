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

  public function testConcreteMethod() {

    $appendedStrings = array();
    $f = function($subject) use (&$appendedStrings) {
      $appendedStrings[] = $subject;
      $this->assertTrue(is_string($subject));
    };
    $contentParser = $this->getMockForTrait(ContentParserTrait::class);
    $contentParser->expects($this->any())
            ->method('append')
            ->will($this->returnCallback($f));
    $mdString = file_get_contents(__DIR__ . '/../../files/test.md');
    $mdToHtml = \Sphp\Stdlib\Parsers\Parser::md()->parseBlock($mdString);
    $contentParser->appendMd($mdString);
    $contentParser->appendMdFile(__DIR__ . '/../../files/test.md');
    print_r($appendedStrings);
    $this->assertTrue($appendedStrings[0] === $mdToHtml);
  }

}
