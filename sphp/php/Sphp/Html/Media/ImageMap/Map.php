<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\AbstractComponent;
use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Sphp\Html\Media\ImageMap\Exceptions\MapException;
use Sphp\Html\Media\ImageMap\Exceptions\CoordinateException;
use Sphp\Html\ContentIterator;

/**
 * Implementation of an HTML map tag
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
class Map extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var Area[] 
   */
  private array $areas = [];

  /**
   * Constructor
   *
   * @param  string $name the value of the name attribute
   * @link   https://www.w3schools.com/TAGS/att_iframe_src.asp src attribute
   */
  public function __construct(string $name = null) {
    parent::__construct('map');
    $this->attributes()->forceVisibility('name');
    if ($name !== null) {
      $this->setName($name);
    }
  }

  /**
   * Sets the value of the required name attribute
   *
   * The required name attribute specifies the name of an image-map.
   *  
   * @param  string $name the value of the name attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_map_name.asp name attribute
   */
  public function setName(string $name) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  /**
   * Returns the value of the name attribute
   *
   * @return string name attribute
   * @link   https://www.w3schools.com/tags/att_iframe_name.asp name attribute
   */
  public function getName(): string {
    return (string) $this->attributes()->getValue('name');
  }

  public function containsArea(Area $area): bool {
    return in_array($area, $this->areas, true);
  }

  /**
   * Adds a new area component to the map
   *
   * @param  Area $area the to add
   * @return $this for a fluent interface
   * @throws MapException if the area object already exists in the map
   */
  public function append(Area $area) {
    if (in_array($area, $this->areas, true)) {
      throw new MapException('Identical ' . $area->getShape() . ' object already exists in this map');
    }
    $this->areas[] = $area;
    return $this;
  }

  /**
   * Appends a polygon area to the map
   *
   * @param  int ...$coord coordinates
   * @return Polygon new instance
   * @throws CoordinateException if the number of coordinates is not divisible by 2
   */
  public function appendPolygon(int ...$coord): Polygon {
    $area = new Polygon(...$coord);
    $this->append($area);
    return $area;
  }

  /**
   * Appends a Circle area to the map
   * 
   * @param  int $x
   * @param  int $y
   * @param  int $radius
   * @return Circle new instance
   */
  public function appendCircle(int $x, int $y, int $radius): Circle {
    $area = new Circle($x, $y, $radius);
    $this->append($area);
    return $area;
  }

  /**
   * Appends a Rectangle area to the map
   *
   * @param  int $x1 the top left x-coordinate
   * @param  int $y1 the top left y-coordinate
   * @param  int $x2 the bottom right x-coordinate
   * @param  int $y2 the bottom right y-coordinate
   * @return Circle new instance
   */
  public function appendRectagle(int $x1 = 0, int $y1 = 0, int $x2 = 0, int $y2 = 0): Rectangle {
    $area = new Rectangle($x1, $y1, $x2, $y2);
    $this->append($area);
    return $area;
  }

  public function contentToString(): string {
    return implode($this->areas);
  }

  /**
   * Returns an external iterator
   *
   * @return ContentIterator<int, Area> external iterator
   */
  public function getIterator(): ContentIterator {
    return new ContentIterator($this->areas);
  }

}
