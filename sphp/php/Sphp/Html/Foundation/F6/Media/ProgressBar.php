<?php

/**
 * ProgressBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\F6\Core\ColourableInterface;
use Sphp\Html\Foundation\F6\Core\ColourableTrait;
use Sphp\Html\Span;
use Sphp\Html\Sections\Paragraph;

/**
 * Class models a Foundation 6 Progress Bar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/progress-bar.html Progress Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ProgressBar extends AbstractComponent implements ColourableInterface {

  use ColourableTrait;

  /**
   *
   * @var Span
   */
  private $progressMeter;

  /**
   * 
   * @param int $progress
   * @param string|null $name the name of the bar
   */
  public function __construct($progress, $name = null) {
    parent::__construct('div');
    $this->progressMeter = new Span();
    $this->progressMeter->cssClasses()->lock('progress-meter');
    $this->progressMeter['progress-meter-text'] = new Paragraph();
    $this->progressMeter["progress-meter-text"]->cssClasses()->lock('progress-meter-text');
    $this->identify();
    $this->attrs()
            ->set('data-sphp-progressbar', 'blaa')
            ->lock('tabindex', 0)
            ->lock('role', 'progressbar')
            ->lock('aria-valuemin', 0)
            ->lock('aria-valuemax', 100)
            ->demand('aria-valuenow')
            ->demand('aria-valuenow')
            ->demand('data-sphp-progressbar-name');
    $this->cssClasses()->lock('progress');
    $this->setProgress($progress)->setBarName($name);
  }

  /**
   * Sets the visibility of the progress bar text
   * 
   * @param  boolean $show true for visible progress text and false otherwise
   * @return self for PHP Method Chaining
   */
  public function showProgressText($show = true) {
    if ($show) {
      $this->progressMeter['progress-meter-text']->setStyle('visibility', 'visible');
    } else {
      $this->progressMeter['progress-meter-text']->setStyle('visibility', 'hidden');
    }
    return $this;
  }

  /**
   * Sets the progress bar name
   * 
   * @param  string $name the optional bar name for build-in javascript library use
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
   */
  public function setProgress($progress, $progressText = null) {
    if ($progressText === null) {
      $progressText = "$progress%";
    }
    $this->attrs()
            ->set('aria-valuenow', $progress)
            ->set('aria-valuetext', $progressText);
    $this->setTitle($progressText);
    $this->progressMeter->inlineStyles()->setProperty('width', "$progress%");
    $this->progressMeter['progress-meter-text']->replaceContent("$progress%");
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->progressMeter->getHtml();
  }

}
