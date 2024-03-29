<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Carousel;

use Sphp\Html\AbstractContent;
use Sphp\Html\Layout\Div;
use Sphp\Html\Container;

/**
 * Class BasicSlide
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BasicSlide extends AbstractContent implements Slide {

  private Div $content;
  private ?string $name;

  /**
   * Constructor
   *
   * @param mixed $content the inner component
   */
  public function __construct($content = null, ?string $name = null) {
    $this->name = $name;
    $this->content = new Div();
    $this->content->addCssClass('carousel-item');
    if ($content !== null) {
      $this->content->append($content);
    }
  }

  public function __destruct() {
    unset($this->content);
  }

  /**
   * Returns the inner component
   *
   * @return Container the inner component
   */
  public function getContent(): Container {
    return $this->content->getContent();
  }

  public function setActive(bool $active = true) {
    if ($active) {
      $this->content->addCssClass('active');
    } else {
      $this->content->removeCssClass('active');
    }
    return $this;
  }

  public function isActive(): bool {
    return $this->content->hasCssClass('active');
  }

  public function getHtml(): string {
    return (string) $this->content;
  }

  public function getSlideName(): ?string {
    return $this->name;
  }

  public function setTimeDelay(?int $delay) {
    $this->content->setAttribute('data-bs-interval', $delay);
  }

}
