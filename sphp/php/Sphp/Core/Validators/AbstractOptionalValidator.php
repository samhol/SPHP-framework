<?php

/**
 * AbstractOptionalValidator.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

/**
 * Abstract superclass for an optional validator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractOptionalValidator extends AbstractValidator implements OptionalValidatorInterface {

  use OptionalValidatorTrait;
}
