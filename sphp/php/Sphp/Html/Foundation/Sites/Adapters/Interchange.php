<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Adapters\AbstractComponentAdapter;
use Sphp\Html\Foundation\Sites\Core\FoundationSettings;
use Sphp\Html\Component;

/**
 * Implements Foundation framework based Interchange adapter
 * 
 * Interchange uses media queries to dynamically load responsive content that 
 * is appropriate for the user's device.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Interchange extends AbstractComponentAdapter {

  private $queries = [];

  /**
   * Constructor
   *
   * @param Component $component
   * @param FoundationSettings $foundation
   */
  public function __construct(Component $component, FoundationSettings $foundation = null) {
    parent::__construct($component);
    $this->queries = [
        'portrait' => null,
        'landscape' => null,
        'small' => null,
        'medium' => null,
        'large' => null,
        'xlarge' => null,
        'xxlarge' => null,
    ];
  }
  
  public function __destruct() {
    unset($this->queries);
    parent::__destruct();
  }

  /**
   * Sets/Unsets the Equalizer to match each row's items in height 
   * @param  string $screenSize
   * @param  string $url
   * @return $this for a fluent interface
   */
  public function setQuery(string $screenSize, string $url = null) {
    $this->queries[$screenSize] = $url;
    $this->setDataInterchangeAttribute();
    return $this;
  }

  protected function setDataInterchangeAttribute() {
    $queryArr = [];
    foreach ($this->queries as $queryType => $url) {
      if (is_string($url)) {
        $queryArr[] = "[$url, $queryType]";
      }
    }
    $value = implode(', ', $queryArr);
    if ($value !== '') {
      $this->attributes()->setAttribute('data-interchange', $value);
    } else {
      $this->attributes()->remove('data-interchange');
    }
    return $this;
  }

}
