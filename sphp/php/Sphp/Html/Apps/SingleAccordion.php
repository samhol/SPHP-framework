<?php

/**
 * SingleAccordion.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

/**
 * Class implements a single accordion component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SingleAccordion extends AbstractSingleAccordion {

  /**
   * Constructs a new instance
   *
   * @param mixed $heading optional heading content (text etc.)content of the accordion
   * @param mixed $content optional content of the accordion
   */
  public function __construct($heading = null, $content = null) {
    parent::__construct("div", $heading);
    $this->cssClasses()->lock("sphp-single-accordion");
    if ($content !== null) {
      $this->body()->append($content);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function head() {
    return parent::head();
  }

  /**
   * {@inheritdoc}
   */
  public function body() {
    return parent::body();
  }

}
