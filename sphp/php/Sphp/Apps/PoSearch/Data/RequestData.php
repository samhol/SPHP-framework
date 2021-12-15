<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\PoSearch\Data;

use Sphp\Network\QueryString;

/**
 * The RequestData class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class RequestData {

  //private PoFileData $poFiles;
  private ?string $hash = null;
  private ?string $type = null;
  private ?string $search = null;
  private array $types = [];
  private int $sliceSize = 10;
  private int $offset = 0;
  private int $page = 0;

  public function __construct(FileBrowser $poFiles) {
    // $this->poFiles = $poFiles;
    $hash = filter_input(\INPUT_GET, 'hash', FILTER_SANITIZE_STRING);
    if (is_string($hash)) {
      $this->hash = $hash;
    }
    if (filter_has_var(INPUT_GET, 'type')) {
      $this->type = filter_input(\INPUT_GET, 'type', FILTER_SANITIZE_STRING);
    }
    if (filter_has_var(INPUT_GET, 'types')) {
      $this->types = filter_input(INPUT_GET, 'types', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    }
    $options = ['options' => ['default' => 10, 'min_range' => 0, 'max_range' => 50]];
    $this->setSliceSize(filter_input(\INPUT_GET, 'view', FILTER_VALIDATE_INT, $options));
    $options1 = ['options' => ['default' => 0, 'min_range' => 0]];
    $this->setOffset(filter_input(\INPUT_GET, 'first', FILTER_VALIDATE_INT, $options1));
    $options2 = ['options' => ['default' => 0, 'min_range' => 0]];
    $this->setPage(filter_input(\INPUT_GET, 'page', FILTER_VALIDATE_INT, $options2));
    if (filter_has_var(INPUT_GET, 'search')) {
      $search = filter_input(\INPUT_GET, 'search', FILTER_SANITIZE_STRING);
      //var_dump($search);
      if ($search !== '') {
        $this->search = $search;
      }
    }
  }

  public function setSliceSize(int $size = 10) {
    $range = range(0, 50, 10);
    //print_r($range);
    if (in_array($size, $range)) {
      $this->sliceSize = $size;
    }
    return $this;
  }

  public function getPage(): int {
    return $this->page;
  }

  public function setPage(int $page) {
    $this->page = $page;
    return $this;
  }

  public function setOffset(int $offset) {
    //  var_dump($offset%$this->sliceSize);
    if ($offset === 0 || ($offset % $this->sliceSize) === 0) {
      $this->offset = $offset;
    }
    return $this;
  }

  public function containsHash(): bool {
    return $this->hash !== null;
  }

  public function getHash(): ?string {
    return $this->hash;
  }
  public function getFileHashes(): array {
    $types = [];
    if (filter_has_var(INPUT_GET, 'hashes')) {
      $types = filter_input(INPUT_GET, 'hashes', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    }
    //print_r($types);
    return $types;
  }

  public function getTypes(): array {
    $types = [];
    if (filter_has_var(INPUT_GET, 'types')) {
      $types = filter_input(INPUT_GET, 'types', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    }
    //print_r($types);
    return $types;
  }

  public function getType(): ?string {
    return $this->type;
  }

  public function hasSearchValue(): bool {
    return $this->search !== null;
  }

  public function getSearch(): ?string {
    return $this->search;
  }

  public function getSliceSize(): int {
    return $this->sliceSize;
  }

  public function getOffset(): int {
    return $this->offset;
  }

  public function toQuery(): QueryString {
    $query = new QueryString("hash={$this->getHash()}&type={$this->type}&search={$this->search}&first={$this->getOffset()}");
    return $query;
  }

}
