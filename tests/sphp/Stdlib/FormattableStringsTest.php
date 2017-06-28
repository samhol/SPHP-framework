<?php

namespace Sphp\Stdlib;

/**
 */
class FormattableStringsTest extends \PHPUnit_Framework_TestCase {

  public function stringsOnly(): array {
    return [
        [""],
        ["foo"],
        ['bar %d %s']
    ];
  }

  /**
   * @dataProvider stringsOnly
   * @param type $string
   */
  public function testFormatOnly(string $string) {
    $s = new FormattableString($string);
    $this->assertSame($string, "$s");
  }

  public function stringsAndArgs(): array {
    return [
        ["", [1, 2, 3]],
        ["foo", [1, 2, 3]],
        ['bar %d %s', [1, 2, 3]],
        ['bar %d %s %s %s', [1, 2, 3, 'foo']],
        ['The %2$s contains %1$d monkeys. That\'s a nice %2$s full of %1$d monkeys.', [3, 'tree']]
    ];
  }

  /**
   * @dataProvider stringsAndArgs
   * @param type $string
   */
  public function testCorrects(string $string, array $args) {
    $s = new FormattableString($string, $args);
    $s->setArguments($args);
    $this->assertSame(vsprintf($string, $args), "$s");
  }

  public function invalidStringsAndArgs(): array {
    return [
        ['&d %sbars %s %s %s', [4, 'foo', 'are']],
        ['The %2$s contains %1$d monkeys. That\'s a nice %2$s full of %1$d monkeys.', ['tree']]
    ];
  }

  /**
   * @dataProvider invalidStringsAndArgs
   * @param type $string
   */
  public function testWrongNumberOfArgs(string $string, array $args) {
    $s = new FormattableString($string, $args);
    try {
      echo $s;
    } catch (\Exception $ex) {
      $this->assertInstanceOf(\ErrorException::class, $ex);
    }
    $this->assertSame($string, "$s");
  }

}
