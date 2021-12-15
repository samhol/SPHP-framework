<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Core\JavaScript;

use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Foundation\Sites\Core\DataOptions\DataOptionTools;
use Sphp\Html\Attributes\MapAttribute;

/**
 * Implementation of JavaScriptOptionHandler
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class JavaScriptOptionHandler implements OptionHandler {

  /**
   * @var MapAttribute 
   */
  private $attributes;

  /**
   * @var MapAttribute 
   */
  private $options;

  public function __construct(AttributeContainer $attributes, int $type = self::ONE) {
    $this->attributes = $attributes;
    $this->attributes->setInstance(new MapAttribute('data-options'));
    $this->options = new MapAttribute('data-options');
  }

  /**
   * Sets a menu option used in a Foundation menu
   * 
   * @param  string $name the name of the option
   * @param  scalar $value the value of the option
   * @return $this for a fluent interface
   */
  public function setOption(string $name, $value) {
    $optionName = DataOptionTools::toOptionName($name);
    $optionValue = DataOptionTools::parseValue($value);
    $this->options->setProperty($optionName, $optionValue);
    return $this;
  }

  public function getOption(string $name) {
    $optionName = DataOptionTools::toOptionName($name);
    return $this->options->getProperty($optionName);
  }

}
