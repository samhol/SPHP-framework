<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Database;

use Sphp\Database\Db;
use Sphp\Database\Exceptions\BadMethodCallException;

/**
 * The DbTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DbTest extends AbstractPDOTest {

  protected function setUp(): void {
    parent::setUp();
    $map = [[\PDO::ATTR_DRIVER_NAME, 'mysql'],];
    $this->pdo->method('getAttribute')
            ->will($this->returnValueMap($map));
  }

  public function testGetPDO(): void {
    $db = new Db($this->pdo);
    $this->assertSame($this->pdo, $db->getPdo());
  }

  public function testQuery(): void {
    $db = new Db($this->pdo);
    $query = $db->query('t1', 't2');
    $this->assertInstanceOf(\Sphp\Database\MySQL\Query::class, $query);
    $this->assertSame('SELECT * FROM t1, t2', $query->getQueryString());
  }

  public function testInsert(): void {
    $db = new Db($this->pdo);
    $query = $db->insert('t', range(1, 3));
    $this->assertInstanceOf(\Sphp\Database\MySQL\Insert::class, $query);
    $this->assertSame('INSERT INTO t VALUES (?, ?, ?)', $query->getQueryString());
    $query = $db->insert('t', [[1, 2], [2, 3]]);
    $this->assertSame('INSERT INTO t VALUES (?, ?), (?, ?)', $query->getQueryString());
  }

  public function testDelete(): void {
    $db = new Db($this->pdo);
    $query = $db->delete('t');
    $this->assertSame('DELETE FROM t', $query->getQueryString());
  }

  public function testDUpdate(): void {
    $db = new Db($this->pdo);
    $query = $db->update('t', ['a' => 'b']);
    $this->assertSame('UPDATE t SET a = ?', $query->getQueryString());
  }

  public function testIncorrectCalls(): void {
    $db = new Db($this->pdo);
    $this->expectException(BadMethodCallException::class);
    $db->foo('t', ['a' => 'b']);
  }

}
