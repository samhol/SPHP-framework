<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Slick;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Layout\Div;
use Sphp\Html\Attributes\JsonAttribute;

/**
 * Implements a Slick Carousel in PHP
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Carousel extends AbstractComponent {

  /**
   * @var Div[]
   */
  private array $slides = [];

  /**
   * Constructor
   *
   * @param  array $properties optional carousel properties
   */
  public function __construct(array $properties = []) {
    parent::__construct('div');
    $this->addCssClass('sphp', 'slick-carousel');
    $this->slides = [];
    $this->setProperties($properties);
  }

  /**
   * Sets the carousel properties
   * 
   * @param  array $props
   * @return $this for a fluent interface
   */
  public function setProperties(array $props) {
    if (!$this->attributes()->contains('data-slick')) {
      $this->attributes()
              ->setInstance(new JsonAttribute('data-slick', $props))->forceVisibility('data-slick');
    } else {
      $this->attributes()->getAttribute('data-slick')->setValue($props);
    }
    return $this;
  }

  /**
   * Appends slide(s) to the orbit
   *
   * **Notes:**
   *
   * 1. `mixed $slides` can be of any type that converts to a PHP string
   * 2. Any `mixed $slides` not extending {@link Slide} is wrapped within {@link Slide} component
   * 3. All items of an array are treated according to note (2)
   *
   * @param  Div $slide
   * @return $this for a fluent interface
   */
  public function append(Div $slide) {
    $this->slides[] = $slide;
    return $this;
  }

  /**
   * Appends a new HTML slide component
   *
   * @param  string $content 
   * @return Div appended slide
   */
  public function appendSlide(mixed $content): Div {
    $slide = new Div($content);
    $this->append($slide);
    return $slide;
  }

  /**
   * Appends a new HTML slide component
   *
   * @param  string $md 
   * @return DivSlide appended instance
   */
  public function appendMd(string $md): Div {
    $slide = new Div();
    $slide->appendMarkdown($md);
    $this->append($slide);
    return $slide;
  }

  /**
   * Appends a new HTML slide component
   *
   * @param  string $path 
   * @return DivSlide appended instance
   */
  public function appendMarkdownFile(string $path): Div {
    $slide = new Div();
    $slide->appendMarkdownFile($path);
    $this->append($slide);
    return $slide;
  }

  public function setSlidesToShow(?int $show) {
    $this->setProperties('slidesToShow', $show);
    return $this;
  }

  public function contentToString(): string {
    return implode($this->slides);
  }

}
