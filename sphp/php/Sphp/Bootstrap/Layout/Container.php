<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Layout;

use Sphp\Html\Layout\Div;
use Sphp\Bootstrap\Exceptions\BootstrapException;
use Sphp\Stdlib\Strings;

/**
 * The Container class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Container extends Div {

  private array $containerTypes = [
      'sm',
      'md',
      'lg',
      'xl',
      'xxl',
      'fluid',
  ];

  /**
   * Constructor
   * 
   * @param  string|null $type the type of the container
   * @throws BootstrapException if invalid container type parameter given
   */
  public function __construct(?string $type = null, array $types = null) {
    parent::__construct();
    if ($types !== null) {
      $this->containerTypes = $types;
    }
    $this->setType($type);
  }

  /**
   * Sets the container type
   * 
   * @param  string|null $type the type of the container
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid container type parameter given
   */
  public function setType(?string $type) {
    $p = $type;
    if ($type === null) {
      $type = 'container';
    }
    if (!str_starts_with($type, 'container')) {
      $type = "container-$type";
    }
    $bbStr = implode('|', $this->containerTypes);
    $valid = "/^(container)(-($bbStr))?$/";
    if (!Strings::match($type, $valid)) {
      throw new BootstrapException("Invalid container type parameter ( $p ) given");
    }
    $this->cssClasses()->removePattern($valid);
    $this->addCssClass($type);
    return $this;
  }

  /**
   * Appends a Row
   * 
   * @param  mixed $content
   * @return Row appended instance 
   */
  public function appendRow($content = null): Row {
    $row = new Row();
    if ($content !== null) {
      $row->appendColumn($content);
    }
    $this->append($row);
    return $row;
  }

}
