<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core\JavaScript;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Core\DataOptions\DataOptionTools;
use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Attributes\PropertyCollectionAttribute;

/**
 * Abstract implementation of a Foundation JavaScript component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/javascript.html#configuring-plugins Foundation Plugins
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractJavaScriptComponent extends AbstractComponent implements JavaScriptComponent {

  /**
   * @var PropertyCollectionAttribute 
   */
  private $options;

  /**
   * Constructor
   * 
   * @param string $tagName
   * @param HtmlAttributeManager $attrManager
   */
  public function __construct(string $tagName, HtmlAttributeManager $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    $this->options = new PropertyCollectionAttribute('data-options');
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
