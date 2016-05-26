<?php

/**
 * AreaInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\Navigation\HyperlinkInterface as HyperlinkInterface;

/**
 * Class Area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-26
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface AreaInterface extends HyperlinkInterface {

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "area";

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   */
  public function getShape();

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   */
  public function getCoordinates();

  public function setRelationship($rel);

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   */
  public function getRelationship();
}
