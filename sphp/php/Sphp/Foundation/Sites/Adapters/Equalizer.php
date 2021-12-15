<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Adapters;

use Sphp\Html\Adapters\AbstractComponentAdapter;
use Sphp\Html\Component;
use Sphp\Html\ContainerComponent;
use Sphp\Html\Attributes\IdAttribute;

/**
 * Implements a Foundation Equalizer.
 *
 * Equalizer makes it dead simple to gives multiple items equal height.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Equalizer extends AbstractComponentAdapter {

  /**
   * Constructor
   * 
   * @param Component $equalizer
   * @param string|null $name
   */
  public function __construct(Component $equalizer, string $name = null) {
    parent::__construct($equalizer);
    $attr = new IdAttribute('data-equalizer', $name);
    $this->attributes()->setInstance($attr);
  }

  /**
   * 
   * @return string
   */
  public function getEqualizerName(): string {
    return $this->getComponent()->attributes()->getValue('data-equalizer');
  }

  /**
   * Sets/Unsets the Equalizer to match each row's items in height 
   * 
   * @param  string $screenSize
   * @return $this for a fluent interface
   */
  public function equalizeOn(string $screenSize) {
    if ($screenSize != 'all') {
      $this->getComponent()->attributes()->setAttribute('data-equalize-on', $screenSize);
    } else {
      $this->getComponent()->attributes()->remove('data-equalize-on');
    }
    return $this;
  }

  /**
   * Sets/Unsets the Equalizer to match each row's items in height 
   * 
   * @param  bool $flag
   * @return $this for a fluent interface
   */
  public function equalizeByRow(bool $flag = true) {
    if ($flag) {
      $this->getComponent()->attributes()->setAttribute('data-equalize-by-row', 'true');
    } else {
      $this->getComponent()->attributes()->remove('data-equalize-by-row');
    }
    return $this;
  }

  /**
   * Adds an equalizer observer
   * 
   * @param  Component $observer
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function addObserver(Component $observer) {
    if ($observer->attributeExists('data-equalizer-watch') && $observer->attributes()->getValue('data-equalizer-watch') !== $this->getEqualizerName()) {
      throw new \Sphp\Exceptions\InvalidArgumentException('Observer already watches an equalizer');
    }
    $observer->setAttribute('data-equalizer-watch', $this->getEqualizerName());
    return $this;
  }

  /**
   * Removes an equalizer observer
   * 
   * @param  Component $observer
   * @return $this for a fluent interface
   */
  public function removeObserver(Component $observer) {
    $observer->attributes()->remove('data-equalizer-watch');
    return $this;
  }

  /**
   * 
   * @param  ContainerComponent $cont
   * @return Equalizer
   */
  public static function equalizeContainer(ContainerComponent $cont): Equalizer {
    $equalizer = new static($cont);
    foreach ($cont as $component) {
      if ($component instanceof Component) {
        $equalizer->addObserver($component);
      }
    }
    return $equalizer;
  }

}
