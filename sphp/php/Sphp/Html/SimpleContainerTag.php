<?php

/**
 * SimpleContainerTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Class is the base class for all HTML tag components acting as HTML component containers
 *
 * **Notes:**
 *
 * Any class extending {@link self} follows these rules:
 * 
 * 1. Any extending class act as a container for other {@link HtmlContent}, text, etc.
 * 2. The type of the content in such container depends solely on the container's purpose of use.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-05-03
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SimpleContainerTag extends AbstractSimpleContainerTag {

  public function setContent($content = null) {
    parent::setContent($content);
    return $this;
  }
  
  public function clear() {
    $this->setContent(null);
    return $this;
  }
  
  public function getContent() {
    return parent::getContent();
  }

}
