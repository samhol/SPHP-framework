<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Component;
use Sphp\Network\Headers\Cookies;
use Sphp\Html\PlainContainer;
use Sphp\Html\Foundation\Sites\Buttons\Button;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;

/**
 * Implements a CookieBanner
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CookieBanner extends AbstractComponent {

  /**
   * @var string
   */
  private $complyCookieName = 'comply_cookie';

  /**
   * @var PlainContainer
   */
  private $text;

  /**
   * @var Button 
   */
  private $acceptBtn;

  public function __construct() {
    parent::__construct('div');
    $this->addCssClass('sphp', 'cookie-banner', 'text-center');
    $this->text = new PlainContainer();
    $this->setAcceptButton('<i class="far fa-check-circle"></i> Accept cookies');
  }

  public function __destruct() {
    unset($this->acceptBtn, $this->text);
    parent::__destruct();
  }

  public function setComplyCookieName(string $name = 'comply_cookie') {
    $this->complyCookieName = $name;
    return $this;
  }

  public function contentContainer(): PlainContainer {
    return $this->text;
  }

  public function setAcceptButton($button): Component {
    if (!$button instanceof Component) {
      $button = Button::pushButton($button);
      $button->addCssClass('button', 'accept');
    }
    $this->acceptBtn = $button;
    $this->acceptBtn->setAttribute('data-sphp-accept-cookies-button', true);
    return $this->acceptBtn;
  }

  public function contentToString(): string {
    $row = new BasicRow();
    $row->appendCell($this->text);
    $row->addCssClass('align-center-middle');
    return $row . $this->acceptBtn;
  }

  public function getHtml(): string {
    if (!Cookies::exists($this->complyCookieName)) {
      return parent::getHtml();
    }
    return '';
  }

}
