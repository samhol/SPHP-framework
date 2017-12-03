<?php

namespace Sphp\Database\Doctrine\Objects;

trait AddressChainedSettingAndGettingTestTrait {

  /**
   * 
   * @return array
   */
  abstract public function addrs();

  /**
   * @dataProvider addrs
   *
   * @param Address $addr
   */
  public function testSettingAnGettingAndChaining(GeographicalAddress $addr) {
    $this->assertSame($addr->setStreet('foo'), $addr);
    $this->assertSame($addr->getStreet(), 'foo');
    $this->assertSame($addr->setCity('foo'), $addr);
    $this->assertSame($addr->getCity(), 'foo');
    $this->assertSame($addr->setCountry('foo'), $addr);
    $this->assertSame($addr->getCountry(), 'foo');
    $this->assertSame($addr->setZipcode('000'), $addr);
    $this->assertSame($addr->getZipcode(), '000');
    $this->assertSame($addr->setMaplink('https://www.google.fi/maps'), $addr);
    $this->assertSame($addr->getMaplink(), 'https://www.google.fi/maps');
  }

}
