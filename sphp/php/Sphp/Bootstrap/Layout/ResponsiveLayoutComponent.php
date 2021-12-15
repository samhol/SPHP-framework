<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Layout;

use Sphp\Bootstrap\Exceptions\BootstrapException;

/**
 * The ResponsiveLayoutComponent Interface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface ResponsiveLayoutComponent {

  public function getBreakpoints(): array;

  public function getPrefix(): ?string;

  public function getSizes(): array;

  /**
   * 
   * @param  string|int ...$width
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid layout parameter was given
   */
  public function setLayouts(... $layout);

  /**
   *  
   * 
   * @param  string|int|null $size
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid size was given
   */
  public function default($size);

  /**
   * 
   * @param  string|null $breakpoint
   * @param  string|int $size
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid breakpoint or size was given
   */
  public function setLayout(?string $breakpoint, $size);

  /**
   * Unsets the Cell width associated with the given screen size
   *
   * @param  string $breakpoint the breakpoint to unset
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid column breakpoint was given
   */
  public function unsetBreakpoint(?string $breakpoint);

  /**
   * Resets the default size setting
   * 
   * @return $this for a fluent interface 
   */
  public function unsetDefault();

  /**
   * Unsets the column width for the breakpoint
   *
   * @param  string|null ... $breakpoint the breakpoints to unset
   * @return $this for a fluent interface
   * @throws BootstrapException if invalid column breakpoint was given
   */
  public function unsetBreakpoints(?string ... $breakpoint);
}
