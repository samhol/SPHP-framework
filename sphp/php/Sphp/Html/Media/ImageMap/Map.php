<?php

/**
 * Map.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\AbstractContainerComponent;

/**
 * Class Models an HTML &lt;map&gt; tag
 * 
 * The &lt;map&gt; tag is used to define a client-side image-map. 
 * An image-map is an image with clickable areas.
 * 
 * The required name attribute of the &lt;map&gt; element is associated with the 
 * &lt;img&gt;'s usemap attribute and creates a relationship between the image and the map.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Map extends AbstractContainerComponent {

  /**
   * Constructs a new instance
   *
   * @param  string $name the value of the name attribute
   * @param  null|AreaInterface|AreaInterface[] $areas the value of the name attribute
   * @link   http://www.w3schools.com/TAGS/att_iframe_src.asp src attribute
   */
  public function __construct($name = null, $areas = null) {
    parent::__construct("map");
    $this->attrs()->demand("name");
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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_map_name.asp name attribute
   */
  public function setName($name) {
    $this->attrs()->set("name", $name);
    return $this;
  }

  /**
   * Returns the value of the name attribute
   *
   * @return string name attribute
   * @link   http://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function getName() {
    return $this->attrs()->get("name");
  }

  /**
   * Sets (replaces) one of the video sources
   *
   * @param  AreaInterface $area the given part of a table
   * @return self for PHP Method Chaining
   */
  public function append(AreaInterface $area) {
    $this->getInnerContainer()->append($area);
    return $this;
  }

}
