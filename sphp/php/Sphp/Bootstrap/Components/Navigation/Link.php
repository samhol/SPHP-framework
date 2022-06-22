<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Navigation;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Lists\StandardListItem;
use Sphp\Html\Navigation\A;

/**
 * The Link class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Link extends AbstractComponent implements StandardListItem {

  /**
   * @var A
   */
  private A $hyperlink;

  /**
   * Constructor
   * 
   * @param A $a
   */
  public function __construct(A $a) {
    parent::__construct('li');
    $this->addCssClass('page-item');
    $a->addCssClass('page-link');
    $a->setRelationship('nofollow');
    $this->hyperlink = $a;
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->hyperlink);
  }

  public function __clone() {
    parent::__clone();
    $this->hyperlink = clone $this->hyperlink;
  }

  public function contentToString(): string {
    return $this->hyperlink->getHtml();
  }

  /**
   * Sets the link disabled
   * 
   * @param  bool $disabled
   * @return $this for a fluent interface
   */
  public function setDisabled(bool $disabled = true) {
    if ($disabled) {
      $this->hyperlink->setAttribute('tabindex', '-1');
      $this->hyperlink->setAttribute('aria-disabled', 'true');
    } else {
      $this->hyperlink->removeAttribute('tabindex');
      $this->hyperlink->removeAttribute('aria-disabled');
    }
    return $this;
  }

  /**
   * Sets the link active
   * 
   * @param  bool $active
   * @return $this for a fluent interface
   */
  public function setActive(bool $active = true) {
    $this->setDisabled(false);
    if ($active) {
      $this->addCssClass('active');
      $this->hyperlink->setAttribute('aria-current', 'page');
    } else {
      $this->removeCssClass('active');
      $this->hyperlink->removeAttribute('aria-current');
    }
    return $this;
  }

  /**
   * Creates a new instance
   * 
   * @param  string $href
   * @param  mixed $content
   * @param  string $target
   * @return Link
   */
  public static function create(string $href = null, $content = null, string $target = null): Link {
    $a = new A($href, $content, $target);
    return new static($a);
  }

}
