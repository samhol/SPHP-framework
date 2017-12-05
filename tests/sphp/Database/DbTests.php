<?php

namespace Sphp\Database;

class DbTests extends \PHPUnit\Framework\TestCase {

  /**
   * @var Db 
   */
  private $gen;

  protected function setUp() {
    $this->gen = Db::instance('test');
    //$this->gen = new StatementStrategy($pdo);
  }

  protected function tearDown() {
    unset($this->gen);
  }

  /**
   * @return array
   */
  public function classNames(): array {
    return [
        ['insert', Insert::class],
        ['query', Query::class],
        ['delete', Delete::class],
        ['update', Update::class],
    ];
  }

  /**
   * @dataProvider classNames
   * @param array $className
   */
  public function testCreation(string $par, string $className) {
    $instance = $this->gen->$par($par);
    $this->assertInstanceof($className, $instance);
  }

  /**
   */
  public function testException() {
    $this->expectException(\Exception::class);
    $instance = $this->gen->createStatement('foo');
  }

}
