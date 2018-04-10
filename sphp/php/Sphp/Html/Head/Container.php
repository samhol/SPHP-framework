<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

/**
 * Description of Container
 *
 * @author samih
 */
class Container implements \Iterator, \Sphp\Html\Content {
  //put your code here
  
  private $important;
  
  private $links;
  
  private $scripts;
  
  private $sequence;
  
  public function __construct() {
    ;
  }
  
  
}
