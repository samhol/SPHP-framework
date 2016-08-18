<?php

/**
 * Figure.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\AbstractContainerComponent as AbstractContainerComponent;
use Sphp\Net\URL as URL;

/**
 * Class Models an HTML &lt;figure&gt; tag
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-02-15
 * @link    http://www.w3schools.com/tags/tag_figure.asp w3schools API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Figure extends AbstractContainerComponent implements LazyLoaderInterface {

  /**
   * Constructs a new instance
   *
   * @param  string|URL|Img $img the image path or the image component
   * @param  mixed|FigCaption $caption the caption content or the caption component
   */
  public function __construct($img = null, $caption = null) {
    parent::__construct("figure");
    $this->setImg($img)->setCaption($caption);
  }

  /**
   * {@inheritdoc}
   */
  public function setLazy($lazy = true) {
    $this->getImg()->setLazy($lazy);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isLazy() {
    return $this->getImg()->isLazy();
  }

  /**
   * Sets the image component
   *
   * @param  string|URL|Img $img the image path or the image component
   * @return self for PHP Method Chaining
   */
  public function setImg($img) {
    if (!($img instanceof Img)) {
      $img = new Img($img);
    }
    $this->content()->set("img", $img);
    return $this;
  }

  /**
   * Returns the image component
   *
   * @return Img the image component
   */
  public function getImg() {
    return $this->content()->get("img");
  }

  /**
   * Sets the caption component
   *
   * @param  mixed|FigCaption $caption the caption content or the caption component
   * @return self for PHP Method Chaining
   */
  public function setCaption($caption) {
    if (!($caption instanceof FigCaption)) {
      $caption = new FigCaption($caption);
    }
    $this->content()->set("caption", $caption);
    return $this;
  }

  /**
   * Returns the caption component
   *
   * @return FigCaption the caption component
   */
  public function getCaption() {
    return $this->content()->get("caption");
  }

}
