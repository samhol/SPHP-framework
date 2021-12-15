<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators\Datetime;

use Sphp\DateTime\ImmutableDateTime;

/**
 * Validates a datetime being later than the limit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LaterThan extends AbstractDateTimeComparisonValidator {

  /**
   * Constructor
   * 
   * @param mixed $dt
   * @param bool $inclusive
   */
  public function __construct($dt = 'now', bool $inclusive = true) {
    parent::__construct($dt, $inclusive);
    $this->getErrors()->setTemplate(static::EXCLUSIVE_ERROR, 'Not later than %s');
    $this->getErrors()->setTemplate(static::INCLUSIVE_ERROR, 'Not later than or equal to %s');
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if (!$value instanceof ImmutableDateTime) {
      try {
        $value = ImmutableDateTime::from($value);
        $this->setValue($value);
      } catch (\Exception $ex) {
        $this->setValue($value);
        $this->getErrors()->appendMessageFromTemplate(static::INVALID);
        return false;
      }
    }
    $comp = $this->getLimit()->compareTo($value);
    /* $v = $this->getLimit()->format('Y-m-d H:i:s');
      /*var_dump($value, $comp);
      if ($this->isInclusive()) {
      echo "--inclusive comp:$comp to $v, ";
      } else {
      echo "--noninclusive comp:$comp to $v, ";
      } */
    $date = $this->getLimit()->format('Y-m-d H:i:s T');
    if ($comp > 0 && $this->isInclusive()) {
      $this->getErrors()->appendMessageFromTemplate(static::INCLUSIVE_ERROR, $date);
    }
    if ($comp >= 0 && !$this->isInclusive()) {
      $this->getErrors()->appendMessageFromTemplate(static::EXCLUSIVE_ERROR, $date);
    }
    return $this->getErrors()->count() === 0;
  }

}
