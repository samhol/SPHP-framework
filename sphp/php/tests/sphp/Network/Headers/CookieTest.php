<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Sphp\Network\Headers;
use Sphp\Network\Cookies\Cookie;
use PHPUnit\Framework\TestCase;
/**
 * Description of CookieTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CookieTest extends TestCase {
  public function testConstructor() :Cookie{
    $cookie = new Cookie('foo');
    $this->assertSame('foo', $cookie->getName());
    return $cookie;
  }
}
