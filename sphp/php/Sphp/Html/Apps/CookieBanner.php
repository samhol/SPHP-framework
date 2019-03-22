<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps;

use Sphp\Html\Tags;
use Sphp\Html\Navigation\Hyperlink;

/**
 * Implements a CookieBanner
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CookieBanner extends \Sphp\Html\AbstractComponent {

  private $text;
  private $acceptBtn;
  private $rejectBtn;

  public function __construct() {
    parent::__construct('div');
    $this->addCssClass('sphp', 'cookie-banner');
    $this->text = Tags::p()->appendMd('**SPHPlayground** uses cookies. By continuing we assume your 
      permission to deploy cookies, as detailed in our  [privacy policy](/manual/privacy_policy.php).');
    $this->acceptButton('<i class="far fa-check-circle"></i> Accept cookies');
    $this->rejectButton('<i class="fas fa-ban"></i> Reject cookies');
  }

  public function acceptButton(string $button) {
    $button = \Sphp\Html\Foundation\Sites\Buttons\Button::pushButton($button);
    $button->addCssClass('button', 'accept');
    $button->setAttribute('data-sphp-accept-cookies', true);
    $this->acceptBtn = $button;
    return $this;
  }

  public function rejectButton($button) {
    $button = \Sphp\Html\Foundation\Sites\Buttons\Button::pushButton($button);
    $button->addCssClass('button', 'error');
    $button->setAttribute('data-sphp-reject-cookies', true);
    $this->rejectBtn = $button;
    return $this;
  }

  public function contentToString(): string {
    $row = new \Sphp\Html\Foundation\Sites\Grids\BasicRow();
    $row->appendCell($this->text . '<div class="button-group">' . $this->acceptBtn . $this->rejectBtn . '</div>')->shrink();
    return $row->addCssClass('align-center-middle')->getHtml();
  }

  public function getHtml(): string {
    if (!filter_has_var(INPUT_COOKIE, 'comply_cookie')) {
      return parent::getHtml();
    }
    return '';
  }

}
