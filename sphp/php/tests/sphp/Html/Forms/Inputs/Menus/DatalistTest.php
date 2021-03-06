<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms\Inputs\Menus;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Inputs\Menus\Datalist;
use Sphp\Html\Forms\Inputs\Menus\Option;
/**
 * Class DatalistTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DatalistTest extends TestCase {


  /**
   * @return Datalist
   */
  public function testConstructor(): Datalist {
    $obj = new Datalist();
    $this->assertCount(0, $obj);
    return $obj;
  }


  /**
   * @depends methodName testConstructor
   * 
   * @param  Datalist $obj
   * @return Datalist
   */
  public function testAppendArray(Datalist $obj): Datalist {
    $opts = [];
    $opts['foo'] = 'bar';
    $opts['bar'] = 'baz';
    $opts['null'] = null;
    $opts['zap'] = new Option('boo', 'splat');
    $obj->appendArray($opts);
    $this->assertCount(4, $obj);
    $this->assertContainsOnly(Option::class, $obj);
    return $obj;
  }
  
}
