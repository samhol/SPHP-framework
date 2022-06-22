<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Navigation\Menus;

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
class NavLink extends A {

  /**
   * Constructor
   *  
   * @param string|null $href
   * @param mixed $content
   * @param string|null $target
   */
  public function __construct(?string $href = null, mixed $content = null, ?string $target = null) {
    parent::__construct($href, $content, $target);
    $this->addCssClass('nav-link');
  }

  /**
   * Sets the link disabled
   * 
   * @param  bool $disabled
   * @return $this for a fluent interface
   */
  public function setDisabled(bool $disabled = true) {
    if ($disabled) {
      $this->setAttribute('tabindex', '-1');
      $this->setAttribute('aria-disabled', 'true');
      $this->addCssClass('disabled');
    } else {
      $this->removeAttribute('tabindex');
      $this->removeAttribute('aria-disabled');
      $this->removeCssClass('disabled');
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
      $this->setAttribute('aria-current', 'page');
    } else {
      $this->removeCssClass('active');
      $this->removeAttribute('aria-current');
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
  public static function create(string $href = null, mixed $content = null, string $target = null): Link {
    $a = new A($href, $content, $target);
    return new static($a);
  }

}
