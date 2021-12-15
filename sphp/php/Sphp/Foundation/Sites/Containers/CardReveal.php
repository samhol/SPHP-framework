<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Containers;

use Sphp\Html\PlainContainer;
use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\Icons\Icon;
use Sphp\Html\Media\Icons\FontAwesome;

/**
 * Implementation of CardReveal
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class CardReveal extends AbstractComponent {

  /**
   * @var PlainContainer
   */
  private $top;

  /**
   * @var PlainContainer
   */
  private $cardSection;

  /**
   * @var PlainContainer
   */
  private $cardReveal;

  /**
   * @var PlainContainer
   */
  private $revealTitleContent;

  /**
   * @var Icon 
   */
  private $openButton;

  /**
   * @var Icon 
   */
  private $closeButton;

  public function __construct() {
    parent::__construct('div');
    $this->attributes()->classes()->protectValue('card card-reveal-wrapper');
    $this->top = new PlainContainer();
    $this->cardSection = new PlainContainer();
    $this->cardReveal = new PlainContainer();
    $this->revealTitleContent = new PlainContainer();
    $this->setOpenIcon(FontAwesome::i('fa fa-angle-up'));
    $this->setCloseIcon(FontAwesome::i('fa fa-angle-down'));
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->top,
            $this->cardSection,
            $this->cardReveal,
            $this->revealTitleContent,
            $this->openButton,
            $this->closeButton);
  }

  public function getFront(): PlainContainer {
    return $this->top;
  }

  public function getCard(): PlainContainer {
    return $this->cardSection;
  }

  public function getRevealTitle(): PlainContainer {
    return $this->revealTitleContent;
  }

  public function getReveal(): PlainContainer {
    return $this->cardReveal;
  }

  public function setCloseIcon(Icon $icon) {
    $this->closeButton = $icon;
   // $icon->pull('right');
    $icon->setSize('2x');
    $icon->useBorders(true);
    return $this;
  }

  public function setOpenIcon(Icon $icon) {
    $this->openButton = $icon;
    //$icon->pull('right');
    $icon->setSize('2x');
    $icon->useBorders(true);
    return $this;
  }

  public function contentToString(): string {
    $output = $this->top . '<div class="card-section"><div class="card-open-button">' . $this->openButton . '</div>';
    $output .= $this->cardSection . '<div class="card-reveal"><div class="card-reveal-title"><div class="title-text">';
    $output .= $this->revealTitleContent . '</div>';
    $output .= '<div class="card-close-button">'.$this->closeButton . '</div></div>';
    $output .= $this->cardReveal . '</div></div>';
    return $output;
  }

}
