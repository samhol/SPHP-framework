<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Media\Icons;

use Sphp\Stdlib\Strings;
use Sphp\Exceptions\InvalidArgumentException;
/**
 * Implements a factory for Font Awesome icon objects
 *
 * @method \Sphp\Html\Media\Icons\Icon i(string $iconName) creates a new icon object
 * @method \Sphp\Html\Media\Icons\Icon span(string $iconName) creates a new icon object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://fontawesome.com/ Font Awesome
 * @filesource
 */
class IconFactory {

  private ?string $iconName = null;
  private bool $decorative = false;
  private ?string $title = null;

  /**
   * Constructor
   * 
   */
  public function __construct() {
    $this->decorative = false;
  }

  public function setIconName(?string $iconName = null) {
    $this->iconName = $iconName;
  }

  /**
   * Creates an icon object
   *
   * @param  string $iconName the file type
   * @param  string $screenReaderText 
   * @return FontAwesomeIcon the corresponding component
   */
  public function __invoke(string $iconName, string $screenReaderText = null): IconObject {
    $icon = $this->createIcon($iconName);
    $icon->setTitle($screenReaderText);
    return $icon;
  }

  public function __toString(): string {
    return $this->createIcon();
  }

  public function getDecorative(): bool {
    return $this->decorative;
  }

  public function setDecorative(bool $decorative) {
    $this->decorative = $decorative;
    return $this;
  }

  /**
   * Optionally pulls the icon to left or right
   * 
   * @param  string|null $title the direction of the pull
   * @return $this for a fluent interface
   */
  public function useTitle(?string $title) {
    $this->title = $title;
    //$this->setDecorative(false);
    return $this;
  }

  /**
   * Creates an icon instance
   * 
   * @param  string $iconName 
   * @return IconObject
   * @throws InvalidArgumentException if icon cannot be created
   */
  public function createIcon(?string $iconName = null): IconObject {
    if ($iconName === null) {
      if ($this->iconName === null) {
        throw new InvalidArgumentException();
      }
      $iconName = $this->iconName;
    }
    if (Strings::match($iconName, '/(fa-(solid|regular|brands|thin|duotone)?)/')) {
      $icon = new FontAwesomeIcon($iconName);
    } else if (Strings::match($iconName, '/(devicon-)/')) {
      $icon = new Devicon($iconName);
    } else {
      $icon = new IconObject($iconName);
    }
    $this->setIconProperties($icon);
    return $icon;
  }

  public function setIconProperties(IconObject $icon): void {
    $icon->setTitle($this->title);
    $icon->setDecorative($this->decorative);
  }

  /**
   * Creates an icon object
   *
   * @param  string $iconName
   * @return IconObject the corresponding component
   */
  public static function get(string $iconName): IconObject {
    $factory = new static();
    $icon = $factory->createIcon($iconName);
    return $icon;
  }

}
