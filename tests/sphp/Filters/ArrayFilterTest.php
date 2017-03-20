<?php

namespace Sphp\Filters;

class ArrayFilterTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var ArrayFilter
   */
  protected $filter;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->filter = new ArrayFilter();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  public function arrayData() {
    $data = array(
        'null' => null,
        'xss' => "libgd<script>alert('foo')</script>",
        'component' => '10',
        'versions' => '2.0.33',
        'testscalar' => array('2', '23', '10', '12'),
        'testarray' => '2',
    );
    return $data;
  }

  /**
   *
   * @param string $path
   * @param mixed $exists
   */
  public function testVariableSetting() {
    $this->filter->setFilter('component', 'strip_tags');
    $this->filter->setFilter('xss', 'strip_tags');
    $this->filter->validateInt('testarray', -1, 1, 0, FILTER_FORCE_ARRAY);
    $filtered  = $this->filter->filter($this->arrayData());
    print_r($filtered);
    //$this->assertTrue(Path::get()->isPathFromRoot($path) === $exists);
  }

}
