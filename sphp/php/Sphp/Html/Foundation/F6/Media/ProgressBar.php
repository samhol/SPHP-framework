<?php

/**
 * ProgressBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Foundation\F6\Core\ColourableInterface as ColourableInterface;
use Sphp\Html\Foundation\F6\Core\ColoringTrait as ColoringTrait;
use Sphp\Html\Div as Div;

/**
 * Class models a Foundation 6 Progress Bar
 *
 * <div class="secondary progress" role="progressbar" tabindex="0" aria-valuenow="25" aria-valuemin="0" aria-valuetext="25 percent" aria-valuemax="100">
  <div class="progress-meter" style="width: 25%"></div>
  </div>
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/progress-bar.html Progress Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ProgressBar extends AbstractComponent implements ColourableInterface {

  use ColoringTrait;

  /**
   * 
   * @param int $progress
   * @param string|null $name
   */
  public function __construct($progress, $name = null) {
    parent::__construct("div");
    $progressMeter = new Div();
    $progressMeter->cssClasses()->lock("progress-meter");
    $this->content()->set("progress-meter", $progressMeter);
    $this->identify();
    $this->attrs()
            ->set("data-sphp-progressbar", "blaa")
            ->lock("tabindex", 0)
            ->lock("role", "progressbar")
            ->lock("aria-valuemin", 0)
            ->lock("aria-valuemax", 100)
            ->demand("aria-valuenow")
            ->demand("aria-valuenow")
            ->demand("data-sphp-progressbar-name");
    $this->cssClasses()->lock("progress");
    $this->setProgress($progress)->setBarName($name);
  }

  /**
   * returns the meter component
   * 
   * @return Div the meter component
   */
  private function getMeter() {
    return $this->content()->get("progress-meter");
  }

  /**
   * returns the meter component
   * 
   * @param  string $name the optional bar name for build-in javascript library use
   * @return self for PHP Method Chaining
   */
  public function setBarName($name) {
    $this->attrs()->set("data-sphp-progressbar-name", $name);
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
            ->set("aria-valuenow", $progress)
            ->set("aria-valuetext", $progressText);
    $this->setTitle($progressText);
    $this->getMeter()->inlineStyles()->setProperty("width", "$progress%");
    return $this;
  }

}
