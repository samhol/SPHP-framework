<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

/**
 * Class Json
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class JsonString extends AbstractValidator {

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('Value of :type type given. String expected');
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    $isValid = true;
    if (is_string($value)) {
      $isValid = (null !== json_decode($value, false, 512));
      if (!$isValid) {
        $this->getMessages()->append('Invalid syntax in JSON string');
      }
    } else {
      $this->setError(self::INVALID);
      $isValid = false;
    }
    return $isValid;
  }

}
