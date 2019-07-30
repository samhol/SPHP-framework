<?php

namespace Sphp\Html\Flow;

use PHPUnit\Framework\TestCase;

class AbstractFlowContainerTest extends TestCase {

  public function testDataTypes() {
    $mock = $this->getMockForAbstractClass(AbstractFlowContainer::class, ['foo']);
    $components['h1'] = $mock->appendH1();
    $this->assertInstanceOf(Headings\H1::class, $components['h1']);
    $components['h2'] = $mock->appendH2();
    $this->assertInstanceOf(Headings\H2::class, $components['h2']);
    $components['h3'] = $mock->appendH3();
    $this->assertInstanceOf(Headings\H3::class, $components['h3']);
    $components['h4'] = $mock->appendH4();
    $this->assertInstanceOf(Headings\H4::class, $components['h4']);
    $components['h5'] = $mock->appendH5();
    $this->assertInstanceOf(Headings\H5::class, $components['h5']);
    $components['h6'] = $mock->appendH6();
    $this->assertInstanceOf(Headings\H6::class, $components['h6']);
    $components['p'] = $mock->appendParagraph();
    $this->assertInstanceOf(Paragraph::class, $components['p']);
    $components['article'] = $mock->appendArticle();
    $this->assertInstanceOf(Article::class, $components['article']);
    $components['section'] = $mock->appendSection();
    $this->assertSame("<foo>" . implode('', $components) . "</foo>", (string) $mock);
  }

}
