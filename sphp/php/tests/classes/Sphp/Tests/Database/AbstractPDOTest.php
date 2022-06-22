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

use PHPUnit\Framework\TestCase;
use PDOStatement;
use PDO;

/**
 * Class AbstractPDOTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractPDOTest extends TestCase {

  protected PDO $pdo;
  protected PDOStatement $pdoStmt;

  protected function setUp(): void {
    $this->pdoStmt = $this->createMock(PDOStatement::class);
    $this->pdoStmt
            ->method('execute')
            ->willReturn(true);
    $this->pdo = $this->createStub(PDO::class);
    $this->pdo
            ->method('prepare')
            ->willReturn($this->pdoStmt);
  }

  protected function tearDown(): void {
    unset($this->pdo);
  }

  public function createPDO(?PDOStatement $pdoStmt = null): PDO {
    $pdo = $this->createStub(PDO::class);
    if ($pdoStmt === null) {
      $pdoStmt = $this->pdoStmt;
    }
    $pdo->method('prepare')
            ->willReturn($pdoStmt);
    return $pdo;
  }

}
