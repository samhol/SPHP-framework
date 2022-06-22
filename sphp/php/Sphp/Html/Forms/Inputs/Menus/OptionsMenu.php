<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Traversable;
use Sphp\Stdlib\Datastructures\Arrayable;
use Countable;

/**
 * The OptionsMenu Interface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface OptionsMenu extends Traversable, Arrayable, Countable {

  /**
   * Prepends content to the component
   *
   * @param  Option $opt the content
   * @return $this for a fluent interface
   */
  public function prepend(Option $opt);

  /**
   * Appends a new option to the component
   * 
   * @param  string|int|float|null $value the value attribute of the option
   * @param  string|int|float|null $content the textual content of the option
   * @return Option appended instance
   * @link   https://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function appendOption(string|int|float|null $value, string|int|float|null $content): Option;

  /**
   * Appends content to the component
   *
   * @param  Option $opt the content
   * @return $this for a fluent interface
   */
  public function append(Option $opt);
}
