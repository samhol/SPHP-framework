<?php

/**
 * AttributeValueValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

use Sphp\Stdlib\Strings;

/**
 * Description of AttributeValueValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AttributeValueValidator extends AbstractAttributeUtils implements AttributeValueValidatorInterface {

  public function isValid($value): bool {
    return Strings::hasStringRepresentation($value);
  }

}
