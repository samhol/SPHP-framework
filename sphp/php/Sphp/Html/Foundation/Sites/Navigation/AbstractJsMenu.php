<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Container;
use Sphp\Html\Attributes\PropertyCollectionAttribute;

/**
 * Implements an abstract menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractJsMenu extends AbstractMenu {

  /**
   * @var PropertyCollectionAttribute 
   */
  private $options;

  /**
   * Constructor
   * 
   * @param string $tagname
   * @param AttributeManager $attrManager
   */
  public function __construct(string $tagname = 'ul', AttributeManager $attrManager = null) {
    parent::__construct($tagname, $attrManager);
    $this->attributes()->setInstance($this->options = new PropertyCollectionAttribute('data-options'));
  }

  /**
   * Sets
   * 
   * @param  string $name
   * @param  scalar $value
   * @return $this
   */
  public function setOption(string $name, $value) {
    if (is_bool($value)) {
      $value = $value ? 'true' : 'false';
    }
    $this->options->setProperty($name, $value);
    return $this;
  }

  public function __destruct() {
    unset($this->options);
    parent::__destruct();
  }

  public function __clone() {
    $this->options = $this->attributes()->getObject('data-options');
    parent::__clone();
  }

}
