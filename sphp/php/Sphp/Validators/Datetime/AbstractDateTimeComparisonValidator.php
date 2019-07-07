<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators\Datetime;

use Sphp\Validators\AbstractLimitValidator;
use Sphp\DateTime\DateTime;

/**
 * Implementation of AbstractDateTimeComparisonValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractDateTimeComparisonValidator extends AbstractLimitValidator {

  /**
   * @var DateTime
   */
  private $limit;

  /**
   * Constructor
   * 
   * @param mixed $dt
   * @param bool $inclusive
   */
  public function __construct($dt = 'now', bool $inclusive = true) {
    parent::__construct($inclusive);
    $this->errors()->setTemplate(static::INVALID, 'Invalid data type given: Cannot parse to DateTime');
    $this->setLimit($dt);
  }

  public function __destruct() {
    unset($this->limit);
    parent::__destruct();
  }

  /**
   * 
   * @param  mixed $limit
   * @return $this
   * @throws InvalidArgumentException if a datetime object cannot be parsed from input
   */
  public function setLimit($limit = 'now') {
    if (!$limit instanceof DateTime) {
      $limit = new DateTime($limit);
    }
    $this->limit = $limit;
    return $this;
  }

  /**
   * 
   * @return DateTime
   */
  public function getLimit(): DateTime {
    return $this->limit;
  }

}
