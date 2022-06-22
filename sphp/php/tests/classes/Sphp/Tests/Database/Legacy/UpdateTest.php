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
use Sphp\Database\Legacy\Update;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * The AbstractUpdateTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class UpdateTest extends AbstractPDOTest {

  public function testConstructor(): void {
    $statement = new Update($this->pdo);
    $this->assertSame($this->pdo, $statement->getPDO());
    $this->assertFalse($statement->isValid());
  }

  public function testSettersAndValidity(): void {
    $statement = new Update($this->pdo);
    $this->assertFalse($statement->isValid());
    $statement->table('t');
    $this->assertFalse($statement->isValid());
    $statement->setColumns(['a' => 'b', 'b' => 'str']);
    $this->assertCount(2, $statement->getParams());
    $this->assertTrue($statement->isValid());
    $this->assertSame('UPDATE t SET a = ?, b = ?', $statement->getQueryString());
    $where = $statement->where('a = 1');
    $where->andEquals('b', 3.1415);
    $this->assertTrue($statement->isValid());
    $this->assertSame("UPDATE t SET a = ?, b = ? $where", $statement->getQueryString());
    $this->assertCount(3, $statement->getParams());
  }

  public function testAffectRows(): void {
    $pdoStmt = $this->createMock(\PDOStatement::class);
    $pdoStmt->method('execute')->willReturn(true);
    $pdoStmt->method('rowCount')->willReturn(1);
    $pdo = $this->createPDO($pdoStmt);
    $statement = new Update($pdo);
    $statement->table('t')->setColumn('a', 1);
    $this->assertSame(1, $statement->affectRows());
  }

  public function testInvalidStateAffectRows(): void {
    $statement = new Update($this->pdo);
    $this->expectException(DatabaseException::class);
    $statement->affectRows();
  }

}
