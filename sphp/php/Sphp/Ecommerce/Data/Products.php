<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Data;

use IteratorAggregate;
use Countable;
use PDO;
use Sphp\Stdlib\Parsers\ParseFactory;

/**
 * Class Cars
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Products implements IteratorAggregate, Countable {

  private PDO $pdo;

  /**
   * Constructor
   * 
   * @param PDO $pdo
   */
  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
  }

  public function __destruct() {
    unset($this->pdo);
  }

  public function getPdo(): PDO {
    return $this->pdo;
  }

  public function storeProduct(Product $row, int $count = 1): ?string {
    $id = null;
    $dbh = $this->getPdo();
    $stmt = $dbh->prepare("
      INSERT INTO products 
            (pid, title, cat, photo, price, description,count  ) 
            VALUES (?,?,?,?,?,?,?)");
    //$row[] = $this->parseType($row);
    //try {
    // $pdo->beginTransaction();
    $data[] = $row->getId();
    $data[] = $row->getName();
    $data[] = $row->getCategory();
    $data[] = $row->getImgPath();
    $data[] = $row->getPrice();
    $data[] = $row->getDescription();
    $data[] = $count;

    try {
      $dbh->beginTransaction();
      // print_r($data);
      $stmt->execute($data);
      $id = $dbh->lastInsertId();
      $dbh->commit();
    } catch (PDOExecption $e) {
      $dbh->rollback();
      print "Error!: " . $e->getMessage() . "</br>";
    }
    //  var_dump($added);
    // $pdo->commit();
    // } catch (\Exception $e) {
    // $pdo->rollback();
    //   echo $e->getMessage();
    // }
    return $id;
  }

  protected function setCategory(string $cat) {
    if (!in_array($cat, $this->categories)) {
      $this->categories[] = $cat;
    }
  }
 
  public function containsProduct(Product $p): bool {
    $stmt = $this->pdo->prepare('
      SELECT COUNT(*) > 0 AS contains
        FROM products WHERE pid = :pid');
    $id = $p->getId();
    $stmt->bindParam(':pid', $id);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return (bool) $result;
  }

  public function contains(string $dbId): bool {
    $stmt = $this->pdo->prepare('
      SELECT COUNT(*) > 0 AS contains
        FROM products WHERE dbId = :dbId');
    $stmt->bindParam(':dbId', $dbId);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return (bool) $result;
  }

  public function getProductByDbId($dbId): ?DbProduct {
    $out = null;
    $stmt = $this->pdo->prepare('SELECT * FROM products WHERE dbId = :dbId');
    $stmt->bindParam(':dbId', $dbId);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if (count($result) > 0) {
      $out = new DbProduct($result);
    }
    return $out;
  }

  public function getProductsByIds(... $id): Products {
    $arr = array_filter($this->products, function ($key)use ($id) {
      return in_array($key, $id);
    }, ARRAY_FILTER_USE_KEY);
    return new Products($arr);
  }

  /**
   * 
   * @param  string $title
   * @return Product|null
   */
  public function getByTitle(string $title): ?Product {
    $out = null;
    $stmt = $this->pdo->prepare('SELECT * FROM products WHERE title = :title');
    $stmt->bindParam(':title', $title);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if (count($result) > 0) {
      $out = new DbProduct($result);
    }
    return $out;
  }

  public function getCategories(): iterable {
    $sql = 'SELECT DISTINCT cat FROM products ORDER BY cat';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
  }

  public function getProductsByCategory(string $cat): iterable {
    $out = null;
    $stmt = $this->pdo->prepare('SELECT * FROM products WHERE cat = :cat');
    $stmt->bindParam(':cat', $cat);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_CLASS, DbProduct::class);
    return $result;
  }

  /**
   * 
   * @param string $sort
   * @return iterable<Product>
   */
  public function getAll(string ... $sort): iterable {
    $sorts = implode(',', $sort);
    $sql = 'SELECT * FROM products';
    if (!empty($sort)) {
      $sorts = implode(',', $sort);
      $sql .= " SORT BY $sorts";
    }
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    foreach ($stmt->fetchAll() as $row) {
      yield new DbProduct($row);
    }
  }

  public function count(): int {
    $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM products');
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return (int) $result;
  }

  /**
   * @return \Traversable<int, Jewel>
   */
  public function getIterator(): \Traversable {
    yield from $this->getAll();
  }

}
