<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;
use Sphp\Exceptions\BadMethodCallException;
/**
 * Implementation of an HTML icon based on fonts or SVG
 *
 * @method \Sphp\Html\Media\Icons\IconTag i(string $iconName) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag span(string $iconName) creates a new icon object
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class IconTag extends AbstractIconTag {

  /**
   * Constructor
   * 
   * @param  string $iconName
   * @param  string $tagName the tag name of the component
   * @throws InvalidArgumentException if the tag name of the component is not valid
   */
  public function __construct(string $iconName, string $tagName = 'i') {
    parent::__construct($tagName);
    $this->cssClasses()->protectValue($iconName);
  }

  /**
   * 
   * @param  string $name
   * @param  array $arguments
   * @return IconTag
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): IconTag {
    if (count($arguments) === 0) {
      throw new BadMethodCallException('Icon name is missing');
    }
    try {
      return new static($arguments[0], $name);
    } catch (\Exception $ex) {
      throw new BadMethodCallException('Cannot create icon ' . __CLASS__ . '::' . $name, $ex->getCode(), $ex);
    }
  }

}
