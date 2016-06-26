<?php

/**
 * AbsractArrowPage.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Navigation\Pagination;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Navigation\Hyperlink as Hyperlink;

/**
 * Class Models an abstract jumping button for Foundation Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbsractArrowPage extends AbstractComponent implements PageInterface {

  use PageTrait;

  /**
   * the inner hyperlink component
   *
   * @var HyperlinkInterface 
   */
  private $content;

  /**
   * Constructs a new instance
   *
   * @param  string|null $href the URL of the link
   * @param  string $target the value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($href = null, $target = "_self") {
    parent::__construct(self::TAG_NAME);
    $this->content = new Hyperlink($href, "", $target);
  }

  /**
   * {@inheritdoc}
   */
  public function getHref() {
    return $this->content->getHref();
  }

  /**
   * {@inheritdoc}
   */
  public function setHref($href, $encode = true) {
    $this->content->setHref($href, $encode);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setTarget($target) {
    $this->content->setTarget($target);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getTarget() {
    return $this->content->getTarget();
  }

  /**
   * {@inheritdoc}
   */
  public function urlEquals($currentUrl = null) {
    return $this->content->urlEquals($currentUrl);
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    $output = "";
    if ($this->isEnabled()) {
      $output .= $this->content;
    }
    return $output;
  }

}
