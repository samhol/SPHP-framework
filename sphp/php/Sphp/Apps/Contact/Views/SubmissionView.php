<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Contact\Views;

use Sphp\Html\Foundation\Sites\Containers\ContentCallout;
use Sphp\Html\Flow\Section;

/**
 * Class SubmissionView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class SubmissionView {

  public function generateResultCallout(DataObject $data = null): ContentCallout {
    $callout = new ContentCallout();
    $callout->setClosable();
    $callout->addCssClass('contact-application');
    $callout->append($this->generateContent($data));
    return $callout;
  }

  abstract public function generateContent($param): Section;
}
