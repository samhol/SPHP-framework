<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

use PHPUnit\Framework\TestCase;

class ScriptsContainerTest extends TestCase {

  /**
   * 
   * @return ScriptsContainer
   */
  public function testConstructor(): ScriptsContainer {
    $scripts = new ScriptsContainer();
    $this->assertSame('', "$scripts");
    $this->assertCount(0, $scripts);
    return $scripts;
  }

  public function srcs(): array {
    $data = [];
    $data[] = ['foo.js'];
    $data[] = 'foo.js';
    return $data;
  }

  /**
   * @depends testConstructor
   * 
   * @param  ScriptsContainer $scripts
   * @return ScriptsContainer
   */
  public function testInsertSameSourceMultipleTimes() {
    $scripts = new ScriptsContainer();
    $script = new ExternalScript('foo.js');
    $this->assertFalse($scripts->contains($script));
    $this->assertSame($scripts, $scripts->insert($script, 10));
    $this->assertCount(1, $scripts);
    $this->assertContains($script, $scripts);
    $this->assertNotSame($script, $fooScript = $scripts->insertExternal('foo.js', 20));
    $this->assertNotSame($script, $barScript = $scripts->insertExternal('bar.js', 10));
    $this->assertNotContains($script, $scripts);
    $this->assertContains($fooScript, $scripts);
    $this->assertCount(2, $scripts);
    $arr = $scripts->toArray();
    $this->assertSame(array_shift($arr), $fooScript);
    $this->assertSame(array_shift($arr), $barScript);
  }

  public function testScriptOrdering() {
    $scripts = new ScriptsContainer();
    $script[6] = $scripts->insertExternal('6.js');
    $script[4] = $scripts->insertInline('4', 1);
    $script[5] = $scripts->insertExternal('5.js', 1);
    $script[0] = $scripts->insertExternal('0.js', 120);
    $script[1] = $scripts->insertExternal('1.js', 20);
    $script[2] = new ExternalScript('2.js');
    $scripts->insert($script[2], 20);
    $script[3] = new InlineScript('3');
    $scripts->insert($script[3], 20);
    $script[7] = $scripts->insertExternal('7.js');

    ksort($script);
    $this->assertEqualsCanonicalizing($script, $scripts->toArray());
    //print_r(array_keys($script));
    $this->assertSame(implode('', $script), (string) $scripts);
  }

  /**
   * @depends testConstructor
   * 
   * @param  ScriptsContainer $scripts
   * @return ScriptsContainer
   */
  public function testInserting(ScriptsContainer $scripts): ScriptsContainer {
    $script[0] = new ExternalScript('foo.js');
    $this->assertFalse($scripts->contains($script[0]));
    $this->assertSame($scripts, $scripts->insert($script[0]));
    $this->assertCount(1, $scripts);
    $this->assertTrue($scripts->contains($script[0]));
    $script[1] = $scripts->insertInline('var $foo = 2;');
    $this->assertCount(2, $scripts);
    $this->assertTrue($scripts->contains($script[1]));
    $script[2] = $scripts->insertExternal('foo1.js');
    $this->assertCount(3, $scripts);
    $this->assertTrue($scripts->contains($script[2]));
    return $scripts;
  }

  /**
   * @depends testInserting
   * 
   * @param  ScriptsContainer $scripts
   * @return ScriptsContainer
   */
  public function testTraversingMethods(ScriptsContainer $scripts): ScriptsContainer {
    $expactedEternals = [];
    $expactedInlines = [];
    foreach ($scripts as $script) {
      if ($script instanceof ExternalScript) {
        $expactedEternals[] = $script;
      } else if ($script instanceof InlineScript) {
        $expactedInlines[] = $script;
      }
    }
    $this->assertContainsOnlyInstancesOf(InlineScript::class, $inlines = $scripts->getInlineScripts());
    $this->assertContainsOnlyInstancesOf(ExternalScript::class, $externals = $scripts->getExternalScripts());
    //$this->assertEqualsCanonicalizing($inlines, $expactedInlines);
    //$this->assertEqualsCanonicalizing($externals, $expactedEternals);
    return $scripts;
  }

  /**
   * @depends testTraversingMethods
   * 
   * @param  ScriptsContainer $scripts
   * @return void
   */
  public function testSettingExternalScriptProperties(ScriptsContainer $scripts): void {
    foreach ($scripts->getExternalScripts() as $script) {
      $this->assertFalse($script->isAsync());
      $this->assertFalse($script->isDefered());
    }
    $this->assertSame($scripts, $scripts->setExternalsAsync(true));
    foreach ($scripts->getExternalScripts() as $script) {
      $this->assertTrue($script->isAsync());
      $this->assertFalse($script->isDefered());
    }

    $this->assertSame($scripts, $scripts->setExternalsAsync(false));
    $this->assertSame($scripts, $scripts->setExternalsDefer(true));
    foreach ($scripts->getExternalScripts() as $script) {
      $this->assertTrue($script->isDefered());
      $this->assertFalse($script->isAsync());
    }
  }

}
