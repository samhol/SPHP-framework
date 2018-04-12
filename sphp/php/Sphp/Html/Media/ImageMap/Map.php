<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\AbstractContainerComponent;

/**
 * Implements an HTML &lt;map&gt; tag
 * 
 * The &lt;map&gt; tag is used to define a client-side image-map. 
 * An image-map is an image with clickable areas.
 * 
 * The required name attribute of the &lt;map&gt; element is associated with the 
 * &lt;img&gt;'s usemap attribute and creates a relationship between the image and the map.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Map extends AbstractContainerComponent {

  /**
   * Constructs a new instance
   *
   * @param  string $name the value of the name attribute
   * @param  null|Area|Area[] $areas the value of the name attribute
   * @link   http://www.w3schools.com/TAGS/att_iframe_src.asp src attribute
   */
  public function __construct(string $name = null, $areas = null) {
    parent::__construct('map');
    $this->attributes()->demand('name');
    if ($name !== null) {
      $this->setName($name);
    }
    if ($areas !== null) {
      foreach(is_array($areas)? $areas : [$areas] as $area) {
        $this->append($area);
      }
    }
  }

  /**
   * Sets the value of the required name attribute
   *
   * The required name attribute specifies the name of an image-map.
   *  
   * @param  string $name the value of the name attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_map_name.asp name attribute
   */
  public function setName(string $name) {
    $this->attributes()->set('name', $name);
    return $this;
  }

  /**
   * Returns the value of the name attribute
   *
   * @return string name attribute
   * @link   http://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function getName(): string {
    return $this->attributes()->getValue('name');
  }

  /**
   * Sets (replaces) one of the video sources
   *
   * @param  Area $area the given part of a table
   * @return $this for a fluent interface
   */
  public function append(Area $area) {
    $this->getInnerContainer()->append($area);
    return $this;
  }

}
