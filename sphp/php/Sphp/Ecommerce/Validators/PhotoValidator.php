<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Validators;

use Sphp\Validators\AbstractValidator;

/**
 * The PhotoValidator class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PhotoValidator extends AbstractValidator {

  private ?string $inputName;

  public function __construct(string $inputName = null) {
    parent::__construct();
    $this->inputName = $inputName;
  }

  protected function checkErrorValue(int $value): bool {
    $out = true;
    switch ($value) {
      case UPLOAD_ERR_OK:
        break;
      case UPLOAD_ERR_NO_FILE:
        $this->getMessages()->append('No file was uploaded.');
        $out = false;
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
        $this->getMessages()->append('Exceeded filesize limit.');
        $out = false;
      default:
        $this->getMessages()->append('Unknown errors.');
        $out = false;
    }
    return $out;
  }

  protected function checkFiletype(string $param): bool {
    if (empty($param)) {
      return false;
    }
    $finfo = new \finfo(FILEINFO_MIME_TYPE);
    if (false === array_search(
                    $finfo->file($param),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ),
                    true
            )) {

      return false;
    }
    return true;
  }

  public function isValid(mixed $value): bool {
    $valid = false;
    $this->setValue($value);
    if (!is_array($value)) {
      $this->getMessages()->append('Not an array value');
    } else if (!array_key_exists($this->inputName, $value)) {
      $this->getMessages()->append('Upload does not containt valid field');
    } else if (!isset($value[$this->inputName]['error']) ||
            is_array($value[$this->inputName]['error'])) {
      $this->getMessages()->append('Invalid parameters');
    } else if (!$this->checkFiletype($value[$this->inputName]['tmp_name'])) {
      $this->getMessages()->append('invalid filetype.');
    } else {
      $valid = $this->checkErrorValue($value[$this->inputName]['error']);
    }
    return $valid;
  }

}
