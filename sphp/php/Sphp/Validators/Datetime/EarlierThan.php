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
 * Validates a datetime being earlier than the limit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class EarlierThan extends AbstractDateTimeComparisonValidator {

  /**
   * Constructor
   * 
   * @param mixed $dt
   * @param bool $inclusive
   */
  public function __construct($dt = 'now', bool $inclusive = true) {
    parent::__construct($dt, $inclusive);
    $this->getMessages()->setTemplate(static::EXCLUSIVE_ERROR, 'Not earlier than %s');
    $this->getMessages()->setTemplate(static::INCLUSIVE_ERROR, 'Not earlier than or equal to %s');
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    if (!$value instanceof ImmutableDateTime) {
      try {
        $value = ImmutableDateTime::from($value);
        $this->setValue($value);
      } catch (\Exception $ex) {
        $this->setValue($value);
        $this->setError(static::INVALID);
        return false;
      }
    }
    $comp = $this->getLimit()->compareTo($value);
    $date = $this->getLimit()->format('Y-m-d H:i:s T');
    if ($comp < 0 && $this->isInclusive()) {
      $this->setError(static::INCLUSIVE_ERROR, [':value' => $date]);
    } else if ($comp <= 0 && !$this->isInclusive()) {
      $this->setError(static::EXCLUSIVE_ERROR, [':value' => $date]);
    }
    return $this->getMessages()->count() === 0;
  }

}
