<?php

namespace Sphp\Stdlib\Datastructures;

class SequenceTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var Sequence
   */
  protected $sequence;

  protected function setUp() {
    $this->sequence = new Sequence();
  }

  protected function tearDown() {
    unset($this->sequence);
  }

  /**
   * 
   * @return array
   */
  public function collectionData() {
    return [
        [range(-1000, 1000)],
        [[0]],
    ];
  }

  /**
   * @dataProvider collectionData
   * @param array $values
   */
  /**
   * 
   * @param array $values
   */
  public function testInsert() {
    $count = count($this->sequence);
    $offset = 0;
    $this->sequence->insert(3, 'three');
    $this->sequence->insert(3, 'three');
    foreach ($values as $value) {
      $this->sequence->append($value);
      $this->assertTrue($this->sequence->contains($value));
      $this->assertSame($this->sequence->offsetGet($offset), $value);
      $offset++;
    }
    $this->assertCount($count, $this->sequence);
  }

}
