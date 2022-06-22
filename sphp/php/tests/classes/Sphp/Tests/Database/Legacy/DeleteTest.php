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
use Sphp\Database\Legacy\Delete;
use Sphp\Database\Exceptions\InvalidStateException;
use Sphp\Database\Exceptions\DatabaseException;

/**
 * The AbstractDeleteTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DeleteTest extends AbstractPDOTest {

  public function testConstructor(): Delete {
    $statement = new Delete($this->pdo);
    $this->assertSame($this->pdo, $statement->getPDO());
    $this->assertFalse($statement->isValid());
    return $statement;
  }

  /**
   * @depends testConstructor
   * 
   * @param Delete $statement
   * @return void
   */
  public function testSettersAndValidity(Delete $statement): void {
    $this->assertFalse($statement->isValid());
    $statement->from('t');
    $this->assertTrue($statement->isValid());
    $this->assertStringStartsWith('DELETE FROM t', $statement->getQueryString());
    $statement->where('a = 1');
    $this->assertTrue($statement->isValid());
    $this->assertSame('DELETE FROM t ' . $statement->where(), $statement->getQueryString());
  }

  public function testInvalidStates(): void {
    $statement = new Delete($this->pdo);
    $this->expectException(InvalidStateException::class);
    $statement->getQueryString();
  }

  public function testAffectRows(): void {
    $pdoStmt = $this->createMock(\PDOStatement::class);
    $pdoStmt->method('execute')->willReturn(true);
    $pdoStmt->method('rowCount')->willReturn(2);
    $pdo = $this->createPDO($pdoStmt);
    $statement = new Delete($pdo);
    $statement->from('t')->where('a = 1');
    $this->assertSame(2, $statement->affectRows());
  }

  public function testInvalidStateAffectRows(): void {
    $statement = new Delete($this->pdo);
    $this->expectException(DatabaseException::class);
    $statement->affectRows();
  }

}
