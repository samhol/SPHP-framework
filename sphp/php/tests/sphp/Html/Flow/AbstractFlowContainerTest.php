<?php

namespace Sphp\Html\Flow;

use PHPUnit\Framework\TestCase;

class AbstractFlowContainerTest extends TestCase {

  public function testPrintHtml() {
    $mock = $this->getMockForAbstractClass(AbstractFlowContainer::class, ['foo']);
    $this->assertInstanceOf(Headings\H1::class, $mock->appendH1());
    $this->assertInstanceOf(Headings\H2::class, $mock->appendH2());
    $this->assertInstanceOf(Headings\H3::class, $mock->appendH3());
    $this->assertInstanceOf(Headings\H4::class, $mock->appendH4());
    $this->assertInstanceOf(Headings\H5::class, $mock->appendH5());
    $this->assertInstanceOf(Headings\H6::class, $mock->appendH6());
    $this->assertInstanceOf(Paragraph::class, $mock->appendParagraph());
    $this->assertInstanceOf(Article::class, $mock->appendArticle());
    $this->assertInstanceOf(Section::class, $mock->appendSection());
  }


}
