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

use Sphp\Html\AbstractComponent;
use Sphp\Bootstrap\Exceptions\BootstrapException;
use Sphp\Bootstrap\Exceptions\BadMethodCallException;

/**
 * The ResponsiveClassManipulator class
 *
 * @method $this sm(int|string $prop = null, $for = null) sets the layout of 'sm' breakpoint
 * @method $this md(int|string $prop = null, $for = null) sets the layout of 'md' breakpoint
 * @method $this lg(int|string $prop = null, $for = null) sets the layout of 'lg' breakpoint
 * @method $this xl(int|string $prop = null, $for = null) sets the layout of 'xl' breakpoint
 * @method $this xxl(int|string $prop = null, $for = null) sets the layout of 'xxl' breakpoint
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */

/**
 * Class AbstractResponsiveComponent
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractResponsiveComponent extends AbstractComponent implements ResponsiveLayoutComponent {

  /**
   * Bootstrap screen size names
   *
   * @var string[]
   */
  protected array $breakpoints = ['sm', 'md', 'lg', 'xl', 'xxl'];
  protected array $sizes = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 'auto'];
  protected ?string $prefix = null;

  /**
   * Constructor
   * 
   * @param string $tagName
   * @param array $settings
   */
  public function __construct(string $tagName, array $settings = []) {
    parent::__construct($tagName);
    //$this->component = $attr;
    $this->unpackSettings($settings);
  }

  protected function unpackSettings(array $settings): void {
    if (array_key_exists('prefix', $settings)) {
      $this->setPrefix($settings['prefix']);
    }
    if (array_key_exists('breakpoints', $settings)) {
      $this->setBreakpoints($settings['breakpoints']);
    }
    if (array_key_exists('sizes', $settings)) {
      $this->setSizes($settings['sizes']);
    }
  }

  public function getBreakpoints(): array {
    return $this->breakpoints;
  }

  public function getPrefix(): ?string {
    return $this->prefix;
  }

  public function getSizes(): array {
    return $this->sizes;
  }

  protected function setBreakpoints(array $breakpoints): void {
    $this->breakpoints = $breakpoints;
  }

  protected function setSizes(array $sizes): void {
    $this->sizes = $sizes;
  }

  protected function setPrefix(?string $prefix): void {
    $this->prefix = $prefix;
  }

  /**
   * Sets a layout value for a screen size specific layout
   * 
   * @param  string $name
   * @param  array $arguments
   * @return $this for a fluent interface 
   * @throws BadMethodCallException if the parameter is invalid
   * @throws BootstrapException if the method does not exist 
   */
  public function __call(string $name, array $arguments) {
    if (!in_array($name, $this->getBreakpoints())) {
      throw new BadMethodCallException("'$name' is not a valid method");
    }
    if (count($arguments) !== 1) {
      throw new BadMethodCallException("Invalid number of arguments given");
    } else if (!$this->isValidSize($arguments[0])) {
      throw new BootstrapException("Invalid size given for $name breakpoint" . $arguments[0]);
    }
    $this->setLayout($name, ...$arguments);
    return $this;
  }

  public function isValidBreakpoint(?string $needle): bool {
    return in_array($needle, $this->getBreakpoints()) || $needle === null;
  }

  public function isValidSize($needle): bool {
    return in_array($needle, $this->getSizes()) || $needle === null;
  }

  /**
   * 
   * @param  string|int ...$width
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid layout parameter was given
   */
  public function setLayouts(... $layout) {
    foreach ($layout as $seed) {
      $params = explode('-', (string) $seed);
      if (count($params) === 1) {
        $this->default(...$params);
      } if (count($params) === 2) {
        $this->setLayout(...$params);
      }
    }
    return $this;
  }

  /**
   *  
   * 
   * @param  string|int|null $size
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid size was given
   */
  public function default($size) {
    if (!$this->isValidSize($size)) {
      throw new BootstrapException("Invalid size given ( $size ) for default breakpoint");
    }
    $this->unsetBreakpoint(null);
    if ($size !== null) {
      if ($this->getPrefix() !== null) {
        $par = "{$this->getPrefix()}-$size";
      } else {
        $par = "$size";
      }
      $this->addCssClass($par);
    }
    return $this;
  }

  /**
   * 
   * @param  string|null $breakpoint
   * @param  string|int $size
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid breakpoint or size was given
   */
  public function setLayout(?string $breakpoint, $size) {
    if (!$this->isValidBreakpoint($breakpoint)) {
      throw new BootstrapException("Invalid breakpoint given ( $breakpoint )");
    }
    if (!$this->isValidSize($size)) {
      throw new BootstrapException("Invalid size given ( $size )");
    }
    if ($breakpoint === null) {
      $this->default($size);
    } else {
      $this->unsetBreakpoint($breakpoint);
      if ($size !== null) {
        $className = '';
        if ($this->getPrefix() !== null) {
          $className .= $this->getPrefix() . '-';
        }
        $className .= "$breakpoint-$size";
        $this->addCssClass($className);
      }
    }
    return $this;
  }

  /**
   * Unsets the Cell width associated with the given screen size
   *
   * @param  string $breakpoint the breakpoint to unset
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid column breakpoint was given
   */
  public function unsetBreakpoint(?string $breakpoint) {
    if (!$this->isValidBreakpoint($breakpoint)) {
      throw new BootstrapException("Invalid breakpoint given ( $breakpoint )");
    }
    if ($breakpoint === null) {
      $this->unsetDefault();
    } else {
      $this->cssClasses()->removePattern("/^(($this->prefix-$breakpoint)(-([1-9]|(1[0-2])|auto))?)$/");
    }
    return $this;
  }

  /**
   * Resets the default size setting
   * 
   * @return $this for a fluent interface 
   */
  public function unsetDefault() {
    $regex = "/^(";
    if ($this->prefix !== null) {
      $regex .= "$this->prefix-";
    }
    $sizes = implode('|', $this->getSizes());
    $regex .= "($sizes))$/";
    $this->cssClasses()->removePattern($regex);
    return $this;
  }

  /**
   * Unsets the column width for the breakpoint
   *
   * @param  string|null ... $breakpoint the breakpoints to unset
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid column breakpoint was given
   */
  public function unsetBreakpoints(?string ... $breakpoint) {
    foreach ($breakpoint as $w) {
      $this->unsetBreakpoint($w);
    }
    return $this;
  }

}
