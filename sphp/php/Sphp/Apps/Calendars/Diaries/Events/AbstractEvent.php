<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Events;

use Sphp\DateTime\DateTime;
use Sphp\DateTime\Duration;

/**
 * The AbstractEvent class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractEvent  {

  /**
   * @var string
   */
  private string $name;

  /**
   * @var string|null
   */
  private ?string $description;

  /**
   * @var mixed
   */
  private $data;

  /**
   * Constructs an instance
   * 
   * @param string $event
   */
  public function __construct(string $event) {
    $this->name = $event;
  }

  public function __destruct() {
    unset($this->data);
  }

  public function getName(): string {
    return $this->name;
  }

  /**
   * Returns the description text
   * 
   * @return string the description text
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
  public function setDescription(?string $description = null) {
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

  abstract public function getStart(): DateTime;

  abstract public function getEnd(): DateTime;

  abstract public function getDuration(): Duration;
}
