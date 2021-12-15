<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Media;

use Sphp\Html\AbstractComponent;
use Sphp\Foundation\Sites\Core\Colourable;
use Sphp\Foundation\Sites\Core\ColourableTrait;
use Sphp\Html\Span;

/**
 * Implements a Progress Bar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/progress-bar.html Progress Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ProgressBar extends AbstractComponent implements Colourable {

  use ColourableTrait;

  /**
   * @var Span
   */
  private $progressMeter;

  /**
   * Constructor
   * 
   * @param int $progress
   * @param string|null $name the name of the bar
   */
  public function __construct(float $progress, string $name = null) {
    parent::__construct('div');
    $this->progressMeter = new Span();
    $this->progressMeter->cssClasses()->protectValue('progress-meter');
    $this->progressMeter['progress-meter-text'] = new Span();
    $this->progressMeter["progress-meter-text"]->cssClasses()->protectValue('progress-meter-text');
    //$this->identify();
    $this->attributes()
            //->setAttribute('data-sphp-progressbar', 'blaa')
            ->protect('tabindex', 0)
            ->protect('role', 'progressbar')
            ->protect('aria-valuemin', 0)
            ->protect('aria-valuemax', 100);
    $this->cssClasses()->protectValue('progress');
    $this->setProgress($progress)->setBarName($name);
  }

  /**
   * Sets the visibility of the progress bar text
   * 
   * @param  bool $show true for visible progress text and false otherwise
   * @return $this for a fluent interface
   */
  public function showProgressText(bool $show = true) {
    if ($show) {
      $this->progressMeter['progress-meter-text']->css()->setProperty('visibility', 'visible');
    } else {
      $this->progressMeter['progress-meter-text']->css()->setProperty('visibility', 'hidden');
    }
    return $this;
  }

  /**
   * Sets the progress bar name
   * 
   * @param  string $name the optional bar name for build-in javascript library use
   * @return $this for a fluent interface
   */
  public function setBarName(string $name = null) {
    $this->attributes()->setAttribute('data-sphp-progressbar-name', $name);
    return $this;
  }

  /**
   * Sets the current progress
   * 
   * @param  int $progress (0-100) the current progress
   * @param  string $progressText the optional screen reader text describing the current progress
   * @return $this for a fluent interface
   */
  public function setProgress(float $progress, string $progressText = null) {
    if ($progressText === null) {
      $progressText = "$progress%";
    }
    $this->attributes()
            ->setAttribute('aria-valuenow', $progress)
            ->setAttribute('aria-valuetext', $progressText);
    $this->attributes()->setAttribute('title', $progressText);
    $this->progressMeter->css()->setProperty('width', "$progress%");
    $this->progressMeter['progress-meter-text']->resetContent("$progress%");
    return $this;
  }

  /**
   * Sets the current progress text
   * 
   * @param  string $progressText the optional screen reader text describing the current progress
   * @return $this for a fluent interface
   */
  public function setProgressText(string $progressText) {
    $this->attributes()
            ->setAttribute('aria-valuetext', $progressText);
    $this->attributes()->setAttribute('title', $progressText);
    $this->progressMeter['progress-meter-text']->resetContent($progressText);
    return $this;
  }

  public function contentToString(): string {
    return $this->progressMeter->getHtml();
  }

}
