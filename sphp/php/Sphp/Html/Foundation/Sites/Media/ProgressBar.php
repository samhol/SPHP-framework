<?php

/**
 * ProgressBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Core\Colourable;
use Sphp\Html\Foundation\Sites\Core\ColourableTrait;
use Sphp\Html\Span;
use Sphp\Html\Content\Paragraph;

/**
 * Implements a Progress Bar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/progress-bar.html Progress Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ProgressBar extends AbstractComponent implements Colourable {

  use ColourableTrait;

  /**
   * @var Span
   */
  private $progressMeter;

  /**
   * Constructs a new instance
   * 
   * @param int $progress
   * @param string|null $name the name of the bar
   */
  public function __construct($progress, $name = null) {
    parent::__construct('div');
    $this->progressMeter = new Span();
    $this->progressMeter->cssClasses()->protect('progress-meter');
    $this->progressMeter['progress-meter-text'] = new Paragraph();
    $this->progressMeter["progress-meter-text"]->cssClasses()->protect('progress-meter-text');
    $this->identify();
    $this->attrs()
            ->set('data-sphp-progressbar', 'blaa')
            ->protect('tabindex', 0)
            ->protect('role', 'progressbar')
            ->protect('aria-valuemin', 0)
            ->protect('aria-valuemax', 100)
            ->demand('aria-valuenow')
            ->demand('aria-valuenow')
            ->demand('data-sphp-progressbar-name');
    $this->cssClasses()->protect('progress');
    $this->setProgress($progress)->setBarName($name);
  }

  /**
   * Sets the visibility of the progress bar text
   * 
   * @param  boolean $show true for visible progress text and false otherwise
   * @return $this for a fluent interface
   */
  public function showProgressText($show = true) {
    if ($show) {
      $this->progressMeter['progress-meter-text']->inlineStyles()->setProperty('visibility', 'visible');
    } else {
      $this->progressMeter['progress-meter-text']->inlineStyles()->setProperty('visibility', 'hidden');
    }
    return $this;
  }

  /**
   * Sets the progress bar name
   * 
   * @param  string $name the optional bar name for build-in javascript library use
   * @return $this for a fluent interface
   */
  public function setBarName($name) {
    $this->attrs()->set('data-sphp-progressbar-name', $name);
    return $this;
  }

  /**
   * Sets the current progress
   * 
   * @param  int $progress (0-100) the current progress
   * @param  string $progressText the optional screenreader text describing the current progress
   * @return $this for a fluent interface
   */
  public function setProgress($progress, $progressText = null) {
    if ($progressText === null) {
      $progressText = "$progress%";
    }
    $this->attrs() 
            ->set('aria-valuenow', $progress)
            ->set('aria-valuetext', $progressText);
    $this->attrs()->set('title', $progressText);
    $this->progressMeter->inlineStyles()->setProperty('width', "$progress%");
    $this->progressMeter['progress-meter-text']->replaceContent("$progress%");
    return $this;
  }

  public function contentToString(): string {
    return $this->progressMeter->getHtml();
  }

}
