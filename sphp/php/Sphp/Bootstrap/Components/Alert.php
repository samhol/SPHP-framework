<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components;

use Sphp\Html\Layout\Div;
use Sphp\Html\Forms\Buttons\PushButton;

/**
 * The Alert class
 * 
 * Provide contextual feedback messages for typical user actions with the handful 
 * of available and flexible alert messages.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Alert extends Div {

  private ?PushButton $button = null;
  private bool $showDismissButton = false;

  public function __construct(string $style = 'alert-primary', bool $showDismissButton = false) {
    parent::__construct();
    $this->attributes()->protect('role', 'alert');
    $this->cssClasses()->protectValue('alert');
    $this->setStyling($style);
    $this->button = new PushButton(); //<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    $this->button->addCssClass('btn-close');
    $this->button->attributes()->protect('data-bs-dismiss', 'alert');
    $this->button->setAttribute('aria-label', 'Close');
    $this->showDismissButton($showDismissButton);
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->button);
  }

  public function __clone() {
    parent::__clone();
    $this->button = clone $this->button;
  }

  /**
   * 
   * @param  bool $showDismissButton
   * @return $this for a fluent interface
   */
  public function showDismissButton(bool $showDismissButton) {
    $this->showDismissButton = $showDismissButton;
    if ($this->showDismissButton) {
      $this->addCssClass('alert-dismissible fade show');
    } else {
      $this->removeCssClass('alert-dismissible fade show');
    }
    return $this;
  }

  /**
   * 
   * @param  string|null $ariaLabel
   * @return $this for a fluent interface
   */
  public function setDismissButtonLabel(?string $ariaLabel) {
    $this->button->setAttribute('aria-label', $ariaLabel);
    return $this;
  }

  /**
   * 
   * @return PushButton
   */
  public function getDismissButton(): PushButton {
    return $this->button;
  }

  /**
   * 
   * @param  string $style
   * @return $this for a fluent interface
   * @throws BootstrapException
   */
  public function setStyling(string $style) {
    if (!str_starts_with($style, 'alert-')) {
      $style = "alert-$style";
    }
    $styles = [
        'alert-primary',
        'alert-secondary',
        'alert-success',
        'alert-danger',
        'alert-warning',
        'alert-info',
        'alert-light',
        'alert-dark'];
    if (!in_array($style, $styles)) {
      throw new BootstrapException('Alert style does not exists');
    }
    $this->removeCssClass(...$styles);
    $this->addCssClass($style);
    return $this;
  }

  public function contentToString(): string {
    $out = parent::contentToString();
    if ($this->showDismissButton) {
      $out .= $this->button;
    }
    return $out;
  }

}
