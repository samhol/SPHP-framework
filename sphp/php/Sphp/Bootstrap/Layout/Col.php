<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Layout;

use Sphp\Html\PlainContainer;
use Sphp\Html\Container;

/**
 * The Col class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Col extends AbstractCol {

  private Container $content;

  /**
   * Constructor
   * 
   * @param Container|null $contentContainer
   * @param array $settings
   */
  public function __construct(?Container $contentContainer = null, array $settings = ['prefix' => 'col']) {
    parent::__construct( $settings);
    if ($contentContainer === null) {
      $contentContainer = new PlainContainer();
    }
    $this->content = $contentContainer;
    $this->default(null);
  }

  public function __destruct() {
    unset($this->content);
    parent::__destruct();
  }

  public function __clone() {
    parent::__clone();
    $this->content = clone $this->content;
  }

  /**
   * 
   * @param  string|int $size
   * @return $this for a fluent interface
   */
  public function default($size) {
    $this->unsetDefault();
    if ($size === null) {
      $this->cssClasses()->add($this->prefix);
    } else {
      $this->cssClasses()->add("$this->prefix-$size");
    }
    return $this;
  }

  public function unsetDefault() {
    $regex = "/^(";
    if ($this->prefix !== null) {
      $regex .= "$this->prefix";
    }
    $s = array_filter($this->getSizes(), function ($size) {
      return $size !== 'auto';
    });
    $sizes = implode('|', $s);
    $regex .= "(-($sizes))?)$/";
    $this->cssClasses()->removePattern($regex);
    return $this;
  }

  public function content(): Container {
    return $this->content;
  }

  public function append($content) {
    $this->content->append($content);
    return $this;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

  public static function create($content, array $settings = ['prefix' => 'col']): Col {
    $col = new static(null, $settings);
    $col->append($content);
    return $col;
  }

}
