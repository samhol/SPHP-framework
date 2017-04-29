<?php

/**
 * Page.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\AbstractComponent;
use Sphp\Stdlib\URL;

/**
 * Implements a page button for a Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/pagination.html Foundation Pagination
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractPage extends AbstractComponent implements PageInterface {

  /**
   *
   * @var Hyperlink 
   */
  private $hyperlink;

  /**
   * Constructs a new instance
   *
   * **Notes:**
   * 
   * * The `href` attribute specifies the URL of the page the link goes to.
   * * If the `href` attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string|URL $href the URL of the link
   * @param  string|null $content the content of the page link
   * @param  string $target optional value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($href = null, $content = null, $target = null) {
    parent::__construct('li');
    $this->hyperlink = new Hyperlink($href, $content, $target);
  }

  public function setContent($content) {
    $this->hyperlink->setContent($content);
    return $this;
  }

  /**
   * 
   * @param  string $label
   * @return self for a fluent interface
   * @link   https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_aria-label_attribute
   */
  public function setAriaLabel($label) {
    $this->attrs()->setAria('label', $label);
    return $this;
  }

  public function setCurrent($active = true) {
    if ((boolean) $active) {
      return $this->addCssClass('current');
    } else {
      return $this->removeCssClass('current');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function isCurrent() {
    return $this->hasCssClass('current');
  }

  /**
   * {@inheritdoc}
   */
  public function disable($disabled = true) {
    if ($disabled) {
      $this->cssClasses()->set('disabled');
    } else {
      $this->cssClasses()->remove('disabled');
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled() {
    return !$this->cssClasses()->contains('disabled');
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    $output = '';
    if (!$this->isEnabled()) {
      $output .= "<span>{$this->hyperlink->contentToString()}</span>";
    } else {
      $output .= $this->hyperlink;
    }
    return $output;
  }

  /**
   * {@inheritdoc}
   */
  public function getHref() {
    return $this->hyperlink->getHref();
  }

  /**
   * {@inheritdoc}
   */
  public function getTarget() {
    return $this->hyperlink->getTarget();
  }

  /**
   * {@inheritdoc}
   */
  public function setHref($href, $encode = true) {
    $this->hyperlink->setHref($href, $encode);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setTarget($target) {
    $this->hyperlink->setTarget($target);
    return $this;
  }

}
