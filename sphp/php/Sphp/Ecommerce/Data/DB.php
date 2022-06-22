<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Data;

use Countable;
use PDO;

/**
 * The DB class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DB implements Countable {

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

  public function count(): int {
    $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM products');
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return (int) $result;
  }

  public function storeProduct(Product $row, int $count = 1): ?string {
    $dbh = $this->getPdo();
    $stmt = $dbh->prepare('INSERT INTO products 
      (pid, title, cat, photo, price, count) 
        VALUES (?,?,?,?,?,?)');
    //$row[] = $this->parseType($row);
    //try {
    // $pdo->beginTransaction();
    $data[] = $row->getId();
    $data[] = $row->getName();
    $data[] = $row->getCategory();
    $data[] = $row->getImgPath();
    $data[] = $row->getPrice();
    $data[] = $count;

    try {
      $dbh->beginTransaction();
      // print_r($data);
      $stmt->execute($data);
      $id = $dbh->lastInsertId();
      $dbh->commit();
    } catch (PDOExecption $e) {
      $id = null;
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

  public function containsProduct(Product $p): bool {
    $stmt = $this->pdo->prepare('
      SELECT COUNT(*) > 0 FROM products WHERE product_id = :pid');
    $id = $p->getId();
    $stmt->bindParam(':pid', $id);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return (bool) $result;
  }

  public function getProductCount(Product $p): int {
    $stmt = $this->pdo->prepare(
            'SELECT count FROM products WHERE product_id = :pid');
    $id = $p->getId();
    $stmt->bindParam(':pid', $id);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return (int) $result;
  }

  public function getAll(): iterable {
    $stmt = $this->pdo->prepare('SELECT * FROM products');
    $stmt->execute();
    $result = $stmt->fetchAll();
    $products = [];
    foreach ($result as $productData) {
      $products[] = new SimpleProduct($productData);
    }
    return $products;
  }

}
