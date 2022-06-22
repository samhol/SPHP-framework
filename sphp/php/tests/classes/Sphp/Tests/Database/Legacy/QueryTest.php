<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Database\Legacy;

use Sphp\Tests\Database\AbstractPDOTest;
use Sphp\Database\Legacy\Query;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * The QueryTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class QueryTest extends AbstractPDOTest {

  protected function setUp(): void {
    parent::setUp();

    $map = [
        [\PDO::FETCH_ASSOC, ['a' => 1, 'b' => 'c']],
            // ['e', 'f', 'g', 'h']
    ];
    $this->pdoStmt->method('fetchAll')
            ->will($this->returnValueMap($map));
  }

  public function testConstructor(): Query {
    $statement = new Query($this->pdo);
    $this->assertSame($this->pdo, $statement->getPDO());
    $this->assertFalse($statement->isValid());
    return $statement;
  }

  /**
   * @depends testConstructor
   * 
   * @param  Query $statement
   * @return Query
   */
  public function testFrom(Query $statement): Query {
    $this->assertFalse($statement->isValid());
    $statement->from('t1', 't2');
    $this->assertTrue($statement->isValid());
    $this->assertStringStartsWith('SELECT * FROM t1, t2', $statement->getQueryString());
    $statement->from('t');
    $this->assertTrue($statement->isValid());
    $this->assertStringStartsWith('SELECT * FROM t', $statement->getQueryString());
    return $statement;
  }

  /**
   * @depends testFrom
   * 
   * @param  Query $statement
   * @return Query
   */
  public function testColumns(Query $statement): Query {
    $statement->columns('a', 'b');
    $this->assertTrue($statement->isValid());
    $this->assertSame('SELECT a, b FROM t', $statement->getQueryString());
    $statement->columns();
    $this->assertSame('SELECT * FROM t', $statement->getQueryString());
    return $statement;
  }

  /**
   * @depends testFrom
   * 
   * @param  Query $statement
   * @return Query
   */
  public function testWhere(Query $statement): Query {
    $statement->where('c = 1');
    $this->assertTrue($statement->isValid());
    $this->assertSame('SELECT * FROM t WHERE (c = 1)', $statement->getQueryString());
    $statement->resetWhere();
    $this->assertSame('SELECT * FROM t', $statement->getQueryString());
    return $statement;
  }

  /**
   * @depends testFrom
   * 
   * @param  Query $statement
   * @return Query
   */
  public function testLimit(Query $statement): Query {
    $statement->limit(1);
    $this->assertTrue($statement->isValid());
    $this->assertSame('SELECT * FROM t LIMIT 1', $statement->getQueryString());
    $statement->limit(1, 1);
    $this->assertTrue($statement->isValid());
    $this->assertSame('SELECT * FROM t LIMIT 1 OFFSET 1', $statement->getQueryString());
    $statement->limit();
    $this->assertTrue($statement->isValid());
    $this->assertSame('SELECT * FROM t', $statement->getQueryString());
    return $statement;
  }

  /**
   * @depends testFrom
   * 
   * @param  Query $statement
   * @return Query
   */
  public function testOrderBy(Query $statement): Query {
    $statement->orderBy('a DESC', 'b ASC');
    $this->assertTrue($statement->isValid());
    $this->assertSame('SELECT * FROM t ORDER BY a DESC, b ASC', $statement->getQueryString());
    $statement->orderBy();
    $this->assertTrue($statement->isValid());
    $this->assertSame('SELECT * FROM t', $statement->getQueryString());
    return $statement;
  }

  /**
   * @depends testFrom
   * 
   * @param  Query $statement
   * @return Query
   */
  public function testGroupBy(Query $statement): Query {
    $statement->groupBy('a', 'b');
    $this->assertTrue($statement->isValid());
    $this->assertSame('SELECT * FROM t GROUP BY a, b', $statement->getQueryString());
    $statement->groupBy();
    $this->assertTrue($statement->isValid());
    $this->assertSame('SELECT * FROM t', $statement->getQueryString());
    return $statement;
  }

  /**
   * @depends testGroupBy
   * 
   * @param  Query $statement
   * @return Query
   */
  public function testHaving(Query $statement): Query {
    $having = $statement->having('COUNT(a) < 0', 'SUM(b) >= 10');
    $this->assertTrue($statement->isValid());
    $this->assertSame("SELECT * FROM t $having", $statement->getQueryString());
    $statement->resetHaving();
    $this->assertTrue($statement->isValid());
    $this->assertSame('SELECT * FROM t', $statement->getQueryString());
    return $statement;
  }

  /**
   *  
   * @return Query
   */
  public function testPrepareAndExecute(): Query {
    $statement = new Query($this->pdo);
    $statement->from('t');
    $this->assertSame($this->pdoStmt, $statement->prepare());
    $this->assertSame($this->pdoStmt, $statement->execute());
    return $statement;
  }

  public function testPrepareFailure(): void {
    $statement = new Query($this->pdo);
    $this->expectException(DatabaseException::class);
    $this->assertSame($this->pdoStmt, $statement->prepare());
  }

  public function testExecuteFailure(): void {
    $statement = new Query($this->pdo);
    $this->expectException(DatabaseException::class);
    $this->assertSame($this->pdoStmt, $statement->execute());
  }

  public function testFetch(): void {
    $statement = new Query($this->pdo);
    $statement->from('t');
    $this->assertSame($statement->fetchAll(\PDO::FETCH_ASSOC), $statement->toArray());
    $this->assertSame($this->pdoStmt->fetchAll(\PDO::FETCH_ASSOC), $statement->fetchAll(\PDO::FETCH_ASSOC));
  }

}
