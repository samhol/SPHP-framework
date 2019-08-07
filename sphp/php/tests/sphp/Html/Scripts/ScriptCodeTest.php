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

class ScriptCodeTest extends TestCase {

  public function createScript(): ScriptCode {
    return new ScriptCode();
  }

  public function testArrayAccessAndAppend() {
    $data[1] = 1;
    $data['foo'] = 'foo';
    $data['bar'] = 'bar';
    $code = new ScriptCode();
    foreach ($data as $key => $val) {
      $this->assertFalse(isset($code[$key]));
      $code[$key] = $val;
      $this->assertTrue(isset($code[$key]));
    }
    foreach($code as $k => $line) {
      $this->assertArrayHasKey($k, $data);
      $this->assertSame($line, $data[$k]);
    }
    $code[''] = 'null';
    $this->assertTrue(isset($code[null]));
    $this->assertTrue(isset($code['']));
    $this->assertSame('null', $code[null]);
    $this->assertSame('null', $code['']);
    $code[1] = '1';
    $code[0] = '0';
    $this->assertSame($code, $code->append('last'));
    $this->assertSame(implode($data) . 'null0last', (string) $code->contentToString());
    foreach ($data as $key => $val) {
      $this->assertTrue(isset($code[$key]));
      unset($code[$key]);
      $this->assertFalse(isset($code[$key]));
    }
  }

}
