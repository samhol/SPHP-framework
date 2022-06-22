<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps;

use Sphp\Html\AbstractContent;
use Sphp\Html\Component;
use Sphp\Html\Media\Icons\IconTag;
use Sphp\Html\Layout\Div;

/**
 * Implements a back to top button for the web page
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class BackToTopButton extends AbstractContent {

  /**
   * @var Component
   */
  private Component $component;

  /**
   * Constructor
   *
   * @param Component $component
   */
  public function __construct(Component $component) {
    $component->attributes()->protect('data-sphp-back-to-top-button', true);
    $this->component = $component;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->component);
  }

  public function getComponent(): Component {
    return $this->component;
  }

  public function getHtml(): string {
    return $this->component->getHtml();
  }

  public static function fromIcon(IconTag $icon): BackToTopButton {
    $div = new Div($icon);
    $div->cssClasses()->protectValue('sphp-back-to-top-button');
    return new static($div);
  }

}
