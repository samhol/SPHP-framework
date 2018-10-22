<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use PHPUnit\Framework\TestCase;

/**
 * Description of LogicalOrTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class LogicalOrTest extends TestCase {

  /**
   * @return StringLengthValidator
   */
  public function testConstructor() {
    $patt = new PatternValidator("/^[a-zA-Z]+$/", "Please insert alphabets only");
    $group = new InArrayValidator([null]);
    $validator = new LogicalOr($group, $patt);
    $this->assertFalse($validator->isValid(1));
    $this->assertTrue($validator->isValid(null));
    $this->assertTrue($validator->isValid('foo'));
    return $validator;
  }

}
