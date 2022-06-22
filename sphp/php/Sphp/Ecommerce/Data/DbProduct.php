<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Data;

/**
 * Class DbProduct
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DbProduct extends SimpleProduct {

  public ?string $dbId = null;
  public array $attrs;

  public function __construct(iterable $data = []) {
    parent::__construct($data);
    $this->dbId = $data['dbId'] ?? null;
   // $this->id = $data['pid'] ?? '';
    $this->attrs = $data['attrs'] ?? [];
    $this->photo = $data['photo'] ?? '/store/__dummy__.svg';
  }

  public function getDbId(): ?string {
    return $this->dbId;
  }

  public function getAttributes(): array {
    return $this->attrs;
  }

  public function getImgPath(): string {
  
    if (is_file(".$this->photo") > 0) {
      return $this->photo;
    } else { 
      return $this->photo;
    }
  }

}
