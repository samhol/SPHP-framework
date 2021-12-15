<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers;

use Sphp\Html\Navigation\A;
use Sphp\Html\Content;

/**
 * Defines a Hyperlink object generator pointing to an existing site 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ItemLinker extends Content {

  /**
   * Returns the default content text of generated hyperlinks
   * 
   * @return string the default content text of generated hyperlinks
   */
  public function getDefaultContent(): string;

  /**
   * Returns the default title of generated hyperlinks
   * 
   * @return string the default title of generated hyperlinks
   */
  public function getDefaultTitle(): string;

  /**
   * Returns the default URL
   * 
   * @return string the default URL
   */
  public function getUrl(): string;

  /**
   * Returns a hyperlink object pointing to an API page
   *
   * @param  string|null $linkText optional alternative link content
   * @return A hyperlink object pointing to an API page
   */
  public function toHyperlink(?string $linkText = null): A;
}
