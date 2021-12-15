<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Media\Icons;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Strings;
use Sphp\Media\SVG\Svg;
use Sphp\Html\Media\Img;

/**
 * Implements a factory for Devicons icon objects
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://konpa.github.io/devicon/ Devicon home
 * @filesource
 */
class Devicons extends IconFactory {

  private bool $colored = false;
  private ?string $svgServerPath = null;
  private ?string $svgClientPath = null;

  public function __construct(?string $path = null) {
    parent::__construct();
    if ($path !== null) {
      $this->useSvgPath($path);
    }
  }

  public function createIcon(?string $name = null): Devicon {
    $icon = new Devicon($this->parseIconName($name));
    $this->setIconProperties($icon);
    $icon->setColored($this->colored);
    return $icon;
  }

  private function parseIconName(string $name) {
    if (!Strings::startsWith($name, 'devicon') || Strings::startsWith($name, 'devicon-plain')) {
      //var_dump((!Strings::startsWith($name, 'devicon')), Strings::startsWith($name, 'devicon-plain'));
      //echo $name;
      $name = "devicon-$name";
    }
    return $name;
  }

  /**
   * Sets/unsets the width of the icon fixed
   * 
   * @param  bool $colored
   * @return $this for a fluent interface
   */
  public function setColored(bool $colored) {
    $this->colored = $colored;
    return $this;
  }

  public function useSvgServerRoot(string $path) {
    if (!is_dir($path)) {
      throw InvalidArgumentException("Invalid SVG root path given");
    }
    $this->svgServerPath = $path;
    return $this;
  }

  public function useSvgClientRoot(string $path) {
    $this->svgClientPath = $path;
    return $this;
  }

  private function parseSvgFile(string $name): string {
    $iconType = preg_replace(['/^(devicons-)/', '/(.svg)$/'], '', $name);
    $iconName = preg_replace('/-(plain|original|wordmark|line)/', '', $iconType);
    $path = "$iconName/$iconType";
    if (!Strings::endsWith($path, 'svg')) {
      $path .= '.svg';
    }
    return $path;
  }

  private function getSvgPathFor(string $name) {
    $path = "$this->svgServerPath/" . $this->parseSvgFile($name);
    return $path;
  }

  private function getSvgClientPathFor(string $name): string {
    $path = "$this->svgClientPath/" . $this->parseSvgFile($name);
    return $path;
  }

  public function createSvg(string $name): Svg {
    return Svg::fileToObject($this->getSvgPathFor($name));
  }

  public function createSvgImg(string $name, ?string $alt = null): Img {
    if ($alt === null) {
      $alt = $name;
    }
    return new Img($this->getSvgClientPathFor($name), $alt);
  }

}
