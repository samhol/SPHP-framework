<?php

/**
 * Equalizer.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Adapters\AbstractComponentAdapter;
use Sphp\Html\ComponentInterface;
use Sphp\Html\ContainerComponentInterface;

/**
 * Implements a Foundation Equalizer.
 *
 * Equalizer makes it dead simple to gives multiple items equal height.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Equalizer extends AbstractComponentAdapter {

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $equalizer
   * @param string|null $name
   */
  public function __construct(ComponentInterface $equalizer, string $name = null) {
    parent::__construct($equalizer);
    $attr = $this->attributes()->setIdentifier('data-equalizer');
    if ($name === null) {
      $attr->identify();
    } else {
      $attr->set($name);
    }
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
      $this->getComponent()->attributes()->set('data-equalize-on', $screenSize);
    } else {
      $this->getComponent()->attributes()->remove('data-equalize-on');
    }
    return $this;
  }

  /**
   * Sets/Unsets the Equalizer to match each row's items in height 
   * 
   * @param  boolean $flag
   * @return $this for a fluent interface
   */
  public function equalizeByRow(bool $flag = true) {
    if ($flag) {
      $this->getComponent()->attributes()->set('data-equalize-by-row', 'true');
    } else {
      $this->getComponent()->attributes()->remove('data-equalize-by-row');
    }
    return $this;
  }

  /**
   * Adds an equalizer observer
   * 
   * @param  ComponentInterface $observer
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function addObserver(ComponentInterface $observer) {
    if ($observer->attributeExists('data-equalizer-watch') && $observer->attributes()->getValue('data-equalizer-watch') !== $this->getEqualizerName()) {
      throw new \Sphp\Exceptions\InvalidArgumentException('');
    }
    $observer->setAttribute('data-equalizer-watch', $this->getEqualizerName());
    return $this;
  }

  /**
   * Removes an equalizer observer
   * 
   * @param  ComponentInterface $observer
   * @return $this for a fluent interface
   */
  public function removeObserver(ComponentInterface $observer) {
    $observer->attributes()->remove('data-equalizer-watch');
    return $this;
  }

  /**
   * 
   * @param  ContainerComponentInterface $cont
   * @return Equalizer
   */
  public static function equalizeContainer(ContainerComponentInterface $cont): Equalizer {
    $equalizer = new static($cont);
    foreach ($cont as $component) {
      if ($component instanceof ComponentInterface) {
        $equalizer->addObserver($component);
      }
    }
    return $equalizer;
  }

}
