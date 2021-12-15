<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Class ArrayKeyChanger
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ArrayKeyChanger implements ArrayFilter {

  private $keys = [];
  private $replace = true;
  private $addEmpty = false;
  private $emptyValue;

  public function __construct(array $keys) {
    $this->keys = $keys;
  }

  public function replaceMatches(bool $replace) {
    $this->replace = $replace;
    return $this;
  }

  public function addEmpty(bool $addEmpty, $emptyValue = null) {
    $this->addEmpty = $addEmpty;
    $this->emptyValue = $emptyValue;
    return $this;
  }

  /**
   * 
   * @param  string|int $old
   * @param  string|int $new
   * @return $this
   * @throws InvalidArgumentException
   */
  public function setKey($old, $new) {
    if (!is_scalar($old)) {
      throw new InvalidArgumentException("Invalid type for changeable key given");
    }
    if (!is_scalar($new)) {
      throw new InvalidArgumentException("Invalid type for new key given");
    }
    $this->keys[$old] = $new;
    return $this;
  }

  /**
   * 
   * @param array $keys
   * @return $this
   * @throws InvalidArgumentException
   */
  public function setKeys(array $keys) {
    foreach ($keys as $old => $new) {
      $this->setKey($old, $new);
    }
    return $this;
  }

  public function __invoke(array $array): array {
    return $this->filter($array);
  }

  public function filter(array $array): array {
    $result = $array;
    foreach ($this->keys as $key => $new) {
      if (array_key_exists($key, $array)) {
        if ($this->replace) {
          unset($result[$key]);
        }
        $result[$new] = $array[$key];
      } else if($this->addEmpty && !array_key_exists($new, $array)) {
        $result[$new] = $this->emptyValue;
      }
    }
    return $result;
  }

}
