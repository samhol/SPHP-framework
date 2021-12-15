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

use Sphp\Html\AbstractComponent;
use Sphp\Foundation\Sites\Core\DataOptions\DataOptionTools;
use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Html\Attributes\MapAttribute;

/**
 * Abstract implementation of a Foundation JavaScript component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/javascript.html#configuring-plugins Foundation Plugins
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractJavaScriptComponent extends AbstractComponent implements JavaScriptComponent {

  /**
   * @var MapAttribute 
   */
  private $options;

  /**
   * Constructor
   * 
   * @param string $tagName
   * @param AttributeContainer $attrManager
   */
  public function __construct(string $tagName, AttributeContainer $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    $this->options = new MapAttribute('data-options');
    $this->attributes()->setInstance($this->options);
  }

  public function __destruct() {
    unset($this->options);
    parent::__destruct();
  }

  public function setOption(string $name, $value) {
    $optionName = DataOptionTools::toOptionName($name);
    $optionValue = DataOptionTools::parseValue($value);
    $this->options->setProperty($optionName, $optionValue);
    return $this;
  }

}
