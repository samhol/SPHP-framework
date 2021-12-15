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

use Sphp\Stdlib\Strings;
use Sphp\Bootstrap\Exceptions\BootstrapException;
use Sphp\Html\CssClassifiableContent;
use Countable;
use IteratorAggregate;
use Traversable;
use Sphp\Html\Attributes\ClassAttribute;

/**
 * The Spacer class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Spacer implements IteratorAggregate, Countable {

  /**
   * @var string[]
   */
  private array $breakpoints;

  /**
   * @var string[]
   */
  private array $spacings = [];

  /**
   * @var string
   */
  private string $regex;

  /**
   * Constructor
   * 
   * @param array $breakpoints
   */
  public function __construct(array $breakpoints = null) {
    if ($breakpoints === null) {
      $breakpoints = ['xs', 'sm', 'md', 'lg', 'xl', 'xxl'];
    }
    $this->breakpoints = $breakpoints;
    $this->regex = "/^((m|p)(t|b|l|r|x|y)?(-(" . implode('|', $this->breakpoints) . "))?(-([1-9]|(1[0-2])|auto)))$/";
  }

  /**
   * 
   * @param  string $spacings
   * @return $this for a fluent interface
   * @throws BootstrapException
   */
  public function useSpacings(string ... $spacings) {
    foreach ($spacings as $value) {
      $this->setValue($value);
    }
    return $this;
  }

  /**
   * 
   * @param  string $param
   * @return $this for a fluent interface
   * @throws BootstrapException
   */
  public function setValue(string $param) {
    if (!Strings::match($param, $this->regex)) {
      throw new BootstrapException("Invalid breakpoint given ($param)");
    }
    $parts = explode('-', $param);
    $key = $parts[0];
    if (count($parts) === 3) {
      $key = $parts[0] . '-' . $parts[1];
    }
    $this->spacings[$key] = $param;
    //print_r($this->spacings);
    return $this;
  }

  /**
   * 
   * @param  CssClassifiableContent $component
   * @return $this for a fluent interface
   */
  public function insertInto(CssClassifiableContent $component) {
    $this->manipulateClassAttribute($component->cssClasses());
    return $this;
  }

  /**
   * 
   * @param  ClassAttribute $atrr
   * @return $this for a fluent interface
   */
  public function manipulateClassAttribute(ClassAttribute $atrr) {
    $atrr->removePattern($this->regex);
    $atrr->add(...array_values($this->spacings));
    return $this;
  }

  public function toArray(): array {
    return $this->spacings;
  }

  public function count(): int {
    return count($this->spacings);
  }

  public function getIterator(): Traversable {
    return new \ArrayIterator($this->spacings);
  }

}
