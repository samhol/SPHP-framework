<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Stdlib\Arrays;

/**
 * Description of AlingmentManager
 *
 * @author samih
 */
class AlingmentManager extends AbstractLayoutManager {

  private static $vertical = [
      'align-right',
      'align-center',
      'align-justify',
      'align-spaced'];
  private static $hor = [
      'align-top',
      'align-middle',
      'align-bottom',
      'align-stretch',];
  private static $selfAlingmentClasses = [
      'align-self-top',
      'align-self-middle',
      'align-self-bottom',
      'align-self-stretch',
  ];

  /**
   * 
   * @param  string|null $alignment
   * @return $this
   */
  public function setVerticalAlignment(string $alignment = null) {
    $this->cssClasses()->remove(self::$vertical);
    if ($alignment !== null && in_array($alignment, self::$vertical)) {
      $this->cssClasses()->add($alignment);
    }
    return $this;
  }

  /**
   * 
   * @param  string|null $alignment
   * @return $this
   */
  public function setHorizontalAlignment(string $alignment = null) {
    $this->cssClasses()->remove(self::$hor);
    if ($alignment !== null && in_array($alignment, self::$hor)) {
      $this->cssClasses()->add($alignment);
    }
    return $this;
  }

  /**
   * 
   * @param  string|null $alignment
   * @return $this
   */
  public function setSelfAlignment(string $alignment = null) {
    $this->cssClasses()->remove(self::$selfAlingmentClasses);
    if ($alignment !== null && in_array($alignment, self::$selfAlingmentClasses)) {
      $this->cssClasses()->add($alignment);
    }
    return $this;
  }

  public function setLayouts(...$layouts) {
    $flatten = Arrays::flatten($layouts);
    foreach ($flatten as $value) {
      if (in_array($value, self::$vertical)) {
        $this->setVerticalAlignment($value);
      } else if (in_array($value, self::$hor)) {
        $this->setVerticalAlignment($value);
      } else if (in_array($value, self::$selfAlingmentClasses)) {
        $this->setSelfAlignment($value);
      }
    }
    return $this;
  }

  public function unsetLayouts(): \this {
    $this->setVerticalAlignment()->setHorizontalAlignment()->setSelfAlignment();
  }

}
