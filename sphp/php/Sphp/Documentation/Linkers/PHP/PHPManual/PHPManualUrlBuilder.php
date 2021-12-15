<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\PHPManual;

use Sphp\Documentation\Linkers\ApiDocURLBuilder;

/**
 * Class PHPManualRootUrlGenerator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PHPManualUrlBuilder extends ApiDocURLBuilder implements ManualURL {

  private string $lang;

  /**
   * Constructor
   * 
   * @param string $lang
   * @param string $apiName
   */
  public function __construct(string $lang = 'en', string $apiName = 'PHP Manual') {
    $this->setLanguage($lang);
    parent::__construct('https://www.php.net/manual/', $apiName);
  }

  public function getRootUrl(): string {
    return parent::getRootUrl() . "{$this->getLanguage()}/";
  }

  public function setLanguage(string $lang) {
    $this->lang = $lang;
    return $this;
  }

  public function getLanguage(): string {
    return $this->lang;
  }

}
