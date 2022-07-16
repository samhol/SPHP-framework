<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\TrafficTracker\Model;

use IteratorAggregate;
use PDO;
use Traversable;
use stdClass;

/**
 * Implements UserAgents database connector
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class UserAgents extends AbstractDB implements IteratorAggregate {

  private UserAgentParser $uaParser;

  public function __construct(PDO $pdo, UserAgentParser $uaParser) {
    parent::__construct($pdo);
    $this->uaParser = $uaParser;
  }

  public function updateUserAgentData(stdClass $ua): bool {
    $out = false;
    if (!$this->containsUserAgentString($ua->raw)) {
      $out = $this->insertNew($ua);
    } else {
      $this->pdo->beginTransaction();
      //echo "\n\tbaaaarrrrr\n";
      $stmt = $this->pdo->prepare(
              'UPDATE userAgents
                  SET calls=calls+1
                  WHERE raw=?');
      $data = [$ua->raw];
      $out = $stmt->execute($data);
      $this->pdo->commit();
    }
    return $out;
  }

  /**
   * 
   * @param  stdClass $uaObj
   * @return bool
   * @throws DataException
   */
  private function insertNew(stdClass $uaObj): bool {
    try {
      $uaQuery = 'INSERT INTO userAgents (raw, crawler, browser, version, browser_maker, majorver) 
                  VALUES (?, ?, ?, ?, ?, ?)';
      $this->pdo->beginTransaction();
      $stmt1 = $this->pdo->prepare($uaQuery);
      $data = [
          $uaObj->raw,
          $uaObj->crawler,
          $uaObj->browser,
          $uaObj->version,
          $uaObj->browser_maker,
          $uaObj->majorver,];
      $result = $stmt1->execute($data);
      $this->pdo->commit();
      return $result;
    } catch (\Exception $e) {
      if ($this->pdo->inTransaction()) {
        $this->pdo->rollback();
      }
      throw new DataException('User Agent insertion failed', 0, $e);
    }
  }

  public function containsUserAgentString(string $ua): bool {
    $stmt = $this->pdo->prepare('SELECT 1 FROM userAgents WHERE raw=?');
    $stmt->execute([$ua]);
    return $stmt->fetchColumn() !== false;
  }

  public function getUserAgent(string $ua): stdClass {
    if (!$this->containsUserAgentString($ua)) {
      $uaObj = UserAgentParser::instance()->fromRawString($ua);
    } else {
      $uaObj = $this->getDbInstance($ua);
    }
    return $uaObj;
  }

  public function getCurrent(): stdClass {
    $ua = $this->uaParser->getBrowscapData($_SERVER['HTTP_USER_AGENT']);
    $ua->raw = $_SERVER['HTTP_USER_AGENT'];
    return $ua;
  }

  public function getIterator(): Traversable {
    $stmt = $this->pdo->prepare('SELECT * FROM userAgents');
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    // $out = new \ArrayIterator();
    /* foreach ($data as $ua) {
      $out[] = new UserAgent((array) $ua);
      } */
    yield from $data;
  }

}
