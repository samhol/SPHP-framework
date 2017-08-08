<?php

namespace Sphp\Database;

use Throwable;
use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidArgumentException;
use Exception;

class NamedPDOParametersTest extends \PHPUnit\Framework\TestCase {

  /**
   * @return array
   */
  public function correctData(): array {
    return [
        ['foo', 'b'],
        ['bar', 'one'],
        ['foobar', true],
    ];
  }

  /**
   * @dataProvider correctData
   * @param mixed $offset
   * @param mixed $value
   */
  public function testArrayAccess($offset, $value) {
    $instance = new NamedParameters();
    $instance[$offset] = $value;
    $this->assertTrue($instance->offsetExists($offset));
    $this->assertTrue($instance->offsetExists(":$offset"));
    $this->assertSame($instance[$offset], $value);
    $this->assertSame($instance[":$offset"], $value);
    $this->assertCount(1, $instance);
  }

  /**
   * @return array
   */
  public function incorrectData(): array {
    return [
        [1, 'b'],
        [null, 'foo'],
        ['::foobar', 'foo'],
        [':foo-bar', 'foo'],
    ];
  }

  /**
   * @dataProvider incorrectData
   * @param mixed $offset
   * @param mixed $value
   */
  public function testIncorrectInsert($offset, $value) {
    $instance = new NamedParameters();
    $this->expectException(InvalidArgumentException::class);
    $instance[$offset] = $value;
  }

  /**
   * @return array
   */
  public function locationData(): array {
    return [
        [
            [
                'name' => 'Hyde Park',
                'street' => 'W2 2UH',
                'zipcode' => '12538',
                'city' => 'London',
                'country' => 'UK',
                'maplink' => 'https://goo.gl/maps/ZWHMuHB4sd22'
            ]
        ]
    ];
  }

  /**
   * @dataProvider locationData
   * @param array $data
   */
  public function testExecution(array $data) {
    $instance = new NamedParameters();
    $instance->setParams($data);

    $pdo = Db::instance()->getPdo();
    $statement1 = $pdo->prepare('SELECT * FROM `locations` '
            . ' WHERE name = :name '
            . ' OR street = :street '
            . ' OR zipcode = :zipcode '
            . ' OR city = :city '
            . ' OR country = :country '
            . ' OR maplink =  :maplink');
    $statement2 = $pdo->prepare('DELETE FROM `locations` '
            . ' WHERE name = :name '
            . ' OR street = :street '
            . ' OR zipcode = :zipcode '
            . ' OR city = :city '
            . ' OR country = :country '
            . ' OR maplink =  :maplink');
    $statement3 = $pdo->prepare('insert into locations (name, street, zipcode, city, country, maplink) values (:name, :street, :zipcode, :city, :country, :maplink)');
    
    $instance->executeIn($statement2);
    $instance->executeIn($statement3);
    print_r($instance->executeIn($statement1)->fetchAll(0));
    $this->assertSame($instance->executeIn($statement1)->fetch(0, \PDO::FETCH_ASSOC), $data);
    
    
  }

}
