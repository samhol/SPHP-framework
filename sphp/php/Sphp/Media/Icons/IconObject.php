<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Media\Icons;

use Sphp\Html\AbstractContent;
use Sphp\Html\Text\I;

/**
 * The IconObject class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IconObject extends AbstractContent implements Icon {

  protected I $icon;

  public function __construct(string $iconName) {
    $this->icon = new I();
    $this->icon->addCssClass($iconName);
  }

  public function __destruct() {
    unset($this->icon);
  }

  public function createTag(): I {
    return clone $this->icon;
  }

  public function getHtml(): string {
    return $this->icon->getHtml();
  }

  public function setTitle(?string $title = null) {
    $this->icon->setAttribute('title', $title);
    if ($title !== null) {
      $this->setDecorative(false);
    }
    return $this;
  }

  public function setDecorative(bool $decorative) {
    if ($decorative === true) {
      $this->icon->attributes()->setAttribute('aria-hidden', 'true');
      $this->icon->attributes()->remove('aria-label');
    } else {
      $this->icon->removeAttribute('aria-hidden');
    }
    return $this;
  }

}
