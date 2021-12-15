<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractComponent;

/**
 * Class BasicSlide
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BasicSlide extends AbstractComponent implements Slide {

  /**
   * @var mixed
   */
  private $content;

  /**
   * Constructor
   *
   * @param mixed $content the inner component
   */
  public function __construct($content = null) {
    parent::__construct('li');
    $this->cssClasses()->protectValue('orbit-slide');
    $this->content = $content;
  }

  public function __destruct() {
    unset($this->content);
    parent::__destruct();
  }

  /**
   * Returns the inner component
   *
   * @return ResponsiveEmbed the inner component
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * Sets or unsets the slide component as active
   *
   * @param  bool $active true for activation and false for deactivation
   * @return $this for a fluent interface
   */
  public function setActive(bool $active = true) {
    if ($active) {
      $this->cssClasses()->add('is-active');
    } else {
      $this->cssClasses()->remove('is-active');
    }
    return $this;
  }

  /**
   * Checks whether the slide component is set as active or not
   *
   * @return bool true if the slide component is set as active, otherwise false
   */
  public function isActive(): bool {
    return $this->cssClasses()->contains('is-active');
  }

  public function contentToString(): string {
    return (string) $this->content;
  }

}
