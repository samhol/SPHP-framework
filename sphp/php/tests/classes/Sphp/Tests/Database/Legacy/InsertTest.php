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
use Sphp\Database\Legacy\Insert;
use Sphp\Database\Exceptions\InvalidStateException;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * The InsertTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class InsertTest extends AbstractPDOTest {

  public function testConstructor(): Insert {
    $statement = new Insert($this->pdo);
    $this->assertSame($this->pdo, $statement->getPDO());
    $this->assertFalse($statement->isValid());
    return $statement;
  }

  public function testSettersAndValidity(): void {
    $statement = new Insert($this->pdo);
    $this->assertFalse($statement->isValid());
    $statement->into('t1');
    $this->assertFalse($statement->isValid());
    $statement->columnNames('c1', 'c2');
    $this->assertFalse($statement->isValid());
    $statement->values('a', 1);
    $this->assertTrue($statement->isValid());
    $this->assertSame('INSERT INTO t1 (c1, c2)  VALUES (?, ?)', $statement->getQueryString());
  }

  public function invalidStates(): iterable {
    yield [new Insert($this->pdo)];
    /* $stmnt1 = new Insert($this->pdo);
      $stmnt1->values('a', 'b', 'c');
      yield [$stmnt1];
      $statement = new Insert($this->pdo);
      $statement->into('t')->valuesFromArray([[1, 2, 3], [1, 3], [11, 21, 31]]);
      yield [$statement]; */
  }

  public function testGetQueryStringFailures(Insert $statement = null) {
    $this->expectException(InvalidStateException::class);
    (new Insert($this->pdo))->getQueryString();
  }

  public function testGetQueryStringFailures1(Insert $statement = null) {
    $this->expectException(InvalidStateException::class);
    (new Insert($this->pdo))->into('t')->valuesFromArray([[1, 2, 3], [], [11, 21, 31]])->getQueryString();
  }

  /**
   * @return void
   */
  public function testUseMultipleRecords(): void {
    $data = [range('a', 'c'), range('d', 'f')];
    $statement = new Insert($this->pdo);
    $statement->into('t');
    $statement->valuesFromArray($data);
    $this->assertCount(6, $params = $statement->getParams());
    $flattenParams = range('a', 'f');
    foreach ($params as $key => $param) {
      $this->assertSame($flattenParams[$key - 1], $param->getValue());
    }
    $this->assertSame("INSERT INTO t VALUES (?, ?, ?), (?, ?, ?)", $statement->getQueryString());
  }

  public function testAffectRows(): void {
    $pdoStmt = $this->createMock(\PDOStatement::class);
    $pdoStmt->method('execute')->willReturn(true);
    $pdoStmt->method('rowCount')->willReturn(1);
    $pdo = $this->createPDO($pdoStmt);
    $statement = new Insert($pdo);
    $statement->into('t')->values('a', 1);
    $this->assertSame(1, $statement->affectRows());
  }

  public function testInvalidStateAffectRows(): void {
    $statement = new Insert($this->pdo);
    $this->expectException(DatabaseException::class);
    $statement->affectRows();
  }

}
