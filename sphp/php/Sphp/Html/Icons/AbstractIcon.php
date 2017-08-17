<?php

/**
 * AbstractIcon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Attributes\AttributeManager;

/**
 * Description of Icon
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractIcon extends AbstractComponent {

  public function __construct(string $tagName, AttributeManager $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    $this->attrs()->set('aria-hidden', 'true');
  }
  
  public function contentToString(): string {
    return '';
  }

}
