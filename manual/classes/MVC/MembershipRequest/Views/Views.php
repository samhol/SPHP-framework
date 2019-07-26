<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\MembershipRequest\Views;

use Sphp\Stdlib\Parsers\Parser;
use Sphp\Html\Lists\Ul;
use Sphp\MVC\MembershipRequest\MembershipRequestData;

/**
 * Description of Views
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Views {

  private function ageToMarkdown(MembershipRequestData $data): string {
    $output = '';
    $dob = $data->getDateOfBirth();
    if ($dob instanceof \DateTimeInterface) {
      $age = $dob->diff(new \DateTime('now'));
      $output .= ' * **Syntymäaika:** ' . $dob->format('j.n.Y') . "\n";
      if ($age->y < 18) {
        $output .= " * **Juniori-jäsen:** {$age->y}-vuotias\n";
      }
    } else {
      $output .= " * **Syntymäaika**: ei annettu (Oletuksena aikuinen)\n";
    }
    return $output;
  }

  /**
   * 
   * @param  MembershipRequestData $data
   * @return string personal data as HTML
   */
  public function personToHtml(MembershipRequestData $data): string {
    $ul = new Ul;
    $ul->addCssClass('form-data');
    $ul->append("<strong>Nimi:</strong> {$data->getFname()} {$data->getLname()}");
    $dob = $data->getDateOfBirth();
    if ($dob instanceof \DateTimeInterface) {
      $age = $dob->diff(new \DateTime('now'));
      $ul->append("<strong>Syntymäaika:</strong> " . $dob->format('j.n.Y'));
      if ($age->y < 18) {
        $ul->append("<strong>Juniori-jäsen:</strong> {$age->y}-vuotias");
      }
    } else {
      $ul->append("<strong>Syntymäaika:</strong> ei annettu (Oletuksena aikuinen)");
    }
    $addrUl = new Ul;
    $ul->addCssClass('address');
    $addrUl->append($data['street']);
    $addrUl->append($data['zipcode'] . ', ' . $data['city']);
    $ul->append("<strong>Osoite:</strong> $addrUl");
    $ul->append("<strong>Sähköpostiosoite:</strong>  {$data['email']}");
    if ($data->getPhone() !== null) {
      $ul->append("<strong>Puhelinnumero:</strong>  {$data['phone']}");
    }
    if ($data->getAdditionalInformation() !== null) {
      $ul->append("<strong>Lisätietoja:</strong>  {$data['information']}");
    }
    return $ul->getHtml();
  }

}
