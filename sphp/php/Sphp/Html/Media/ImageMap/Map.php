<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\AbstractComponent;
use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Traversable;
use Sphp\Exceptions\InvalidArgumentException;

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
  private $areas = [];

  /**
   * Constructor
   *
   * @param  string $name the value of the name attribute
   * @link   http://www.w3schools.com/TAGS/att_iframe_src.asp src attribute
   */
  public function __construct(string $name = null) {
    parent::__construct('map');
    $this->attributes()->demand('name');
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
   * @link   http://www.w3schools.com/tags/att_map_name.asp name attribute
   */
  public function setName(string $name) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  /**
   * Returns the value of the name attribute
   *
   * @return string name attribute
   * @link   http://www.w3schools.com/tags/att_iframe_name.asp name attribute
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
   * @throws InvalidArgumentException if the area object already exists in the map
   */
  public function append(Area $area) {
    if (in_array($area, $this->areas, true)) {
      throw new InvalidArgumentException('Identical ' . $area->getShape() . ' object already exists in the map');
    }
    $this->areas[] = $area;
    return $this;
  }

  /**
   * Appends a polygon area to the map
   *
   * @param  int[] $coords coordinates as an array
   * @param  string|null $href
   * @param  string|null $alt
   * @return Polygon new instance
   * @throws InvalidArgumentException if the area object already exists in the map
   */
  public function appendPolygon(array $coords = null, string $href = null, string $alt = null): Polygon {
    $area = new Polygon($coords, $href, $alt);
    $this->append($area);
    return $area;
  }

  /**
   * Appends a Circle area to the map
   *
   * @param  int[] $coords coordinates as an array
   * @param  string|null $href
   * @param  string|null $alt
   * @return Circle new instance
   * @throws InvalidArgumentException if the area object already exists in the map
   */
  public function appendCircle(array $coords = null, string $href = null, string $alt = null): Circle {
    $area = new Circle($coords, $href, $alt);
    $this->append($area);
    return $area;
  }

  /**
   * Appends a Rectangle area to the map
   *
   * @param  int[] $coords coordinates as an array
   * @param  string|null $href
   * @param  string|null $alt
   * @return Circle new instance
   * @throws InvalidArgumentException if the area object already exists in the map
   */
  public function appendRectagle(array $coords = null, string $href = null, string $alt = null): Rectangle {
    $area = new Rectangle($coords, $href, $alt);
    $this->append($area);
    return $area;
  }

  public function contentToString(): string {
    return implode($this->areas);
  }

  public function getIterator(): Traversable {
    return new \Sphp\Html\ContentIterator($this->areas);
  }

}
