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

use InvalidArgumentException;

/**
 * The SimpleProduct class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SimpleProduct extends AbstractProduct {

  public string $id;
  public string $name;
  public string $photo;
  public string $type;
  public string $category;
  public bool $available;
  public int $price;
  public string $info;
  public array $attrs;
  public string $description;

  public function __construct(iterable $data = []) {
    try {
      $this->id = $data['id'] ?? '';
      $this->name = $data['title'] ?? '';
      $this->type = $data['tyyppi'] ?? 'tuntematon tyyppi';
      $this->category = mb_strtolower($data['cat'] ?? 'other');
      $this->available = $data['saatavilla'] ?? false;
      if (isset($data['price'])) {
        $this->price = (int) $data['price'];
      } else {
        $this->price = 0;
      }
      $this->photo = $data['photo'] ?? '/store/__dummy__.svg';
      $this->info = $data['attrs'] ?? '__dummy__.svg';
      $this->description = $data['description'] ?? '';
    } catch (\Error $ex) {
      throw new InvalidArgumentException($ex->getMessage());
    };
  }

  public function getType(): string {
    return $this->type;
  }

  public function getCategory(): string {
    return $this->category;
  }

  public function getName(): string {
    return $this->name;
  }

  public function getTax(): int {
    return 24;
  }

  public function getPretaxPrice(): int {
    return (int) round(((100 - 24) / 100) * $this->price);
  }

  public function getPrice(): int {
    return $this->price;
  }

  public function getId(): string {
    return $this->id;
  }

  public function isAvailable(): bool {
    return $this->available;
  }

  public function getImgPath(): string {
    if(!is_file($this->photo)) {
    return '/store/__dummy__.svg';
    } else {
      
    return $this->photo;
    }
  }

  public function getDescription(): string {
    return $this->description;
  }

}
