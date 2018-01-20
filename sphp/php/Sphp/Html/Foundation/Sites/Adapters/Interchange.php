<?php

/**
 * Interchange.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Adapters\AbstractComponentAdapter;
use Sphp\Html\ComponentInterface;

/**
 * Implements Foundation framework based Interchange adapter
 * 
 * Interchange uses media queries to dynamically load responsive content that 
 * is appropriate for the user's device.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Interchange extends AbstractComponentAdapter {

  private $queries = [];

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component) {
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
      $this->attributes()->set('data-interchange', $value);
    } else {
      $this->attributes()->remove('data-interchange');
    }
    return $this;
  }

}
