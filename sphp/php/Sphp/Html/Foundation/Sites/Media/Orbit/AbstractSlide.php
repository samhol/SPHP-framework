<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

/**
 * Description of AbstractSlide
 *
 * @author samih
 */
abstract class AbstractSlide extends \Sphp\Html\AbstractComponent implements Slide {

  /**
   * Constructor
   *
   * @param  mixed $content the content of the slide
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct() {
    parent::__construct('li');
    $this->cssClasses()->protectValue('orbit-slide');
  }
  /**
   * Sets or unsets the slide component as active
   *
   * @param  boolean $active true for activation and false for deactivation
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
   * @return boolean true if the slide component is set as active, otherwise false
   */
  public function isActive(): bool {
    return $this->cssClasses()->contains('is-active');
  }

  public function getBullet($slideText, $currentSlideText): Bullet {
    return new Bullet($slideText, $currentSlideText);
  }

}
