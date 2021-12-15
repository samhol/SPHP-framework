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

use Sphp\Documentation\Linkers\ApiUrlGenerator;

/**
 * Interface ManualURL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface ManualURL extends ApiUrlGenerator {

  /**
   * Sets the language of the PHP documentation
   * 
   * @param  string $lang two letter language code 
   * @return $this for a fluent interface
   */
  public function setLanguage(string $lang);

  /**
   * Returns the language of the PHP manual documentation
   * 
   * @return string the language of the PHP manual documentation
   */
  public function getLanguage(): string;
}
