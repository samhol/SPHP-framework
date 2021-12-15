<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries;

use Sphp\DateTime\Constraints\DateConstraint;

/**
 * Implements a basic diary log
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class BasicLog extends AbstractCalendarEntry implements Log {

  /**
   * @var string 
   */
  private $name;

  /**
   * @var string 
   */
  private $description;

  /**
   * @var mixed
   */
  private $data;

  /**
   * Constructor
   * 
   * @param DateConstraint $constraint date constraints
   * @param string $name
   * @param string|null $description
   */
  public function __construct(DateConstraint $constraint, string $name, ?string $description = null) {
    parent::__construct($constraint);
    $this->setName($name)->setDescription($description);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->name, $this->description, $this->data);
    parent::__destruct();
  }

  /**
   * 
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Sets the name of the log
   * 
   * @param  string $name the name of the log
   * @return $this for a fluent interface
   */
  public function setName(string $name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Returns the description text
   * 
   * @return string|null the description text
   */
  public function getDescription(): ?string {
    return $this->description;
  }

  /**
   * Sets the description text
   * 
   * @param  string|null $description the description text
   * @return $this for a fluent interface
   */
  public function setDescription(?string $description) {
    $this->description = $description;
    return $this;
  }

  /**
   * 
   * @return mixed
   */
  public function getData() {
    return $this->data;
  }

  /**
   * 
   * @param  mixed $data
   * @return $this
   */
  public function setData($data) {
    $this->data = $data;
    return $this;
  }

}
