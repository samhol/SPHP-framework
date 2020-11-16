<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Head;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Head\Links\ImmutableLinkData;
use Sphp\Html\Head\MetaFactory;
use Sphp\Html\Head\ImmutableMeta;
use Sphp\Html\Utils\Mime;

/**
 * Class MetaDataObjectTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MetaFactoryTest extends TestCase {

  public function testMetaFactoring(): void {
    $factory = MetaFactory::build();
    $this->assertEquals(new ImmutableMeta(['property' => 'foo', 'content' => 'bar']), $factory->property('foo', 'bar'));
    $this->assertEquals(new ImmutableMeta(['charset' => 'UTF-8']), $factory->charset('UTF-8'));
    $this->assertEquals(new ImmutableMeta(['name' => 'foo', 'content' => 'bar']), $factory->namedContent('foo', 'bar'));
    $this->assertEquals(new ImmutableMeta(['http-equiv' => 'foo', 'content' => 'bar']), $factory->httpEquiv('foo', 'bar'));
    $this->assertEquals(new ImmutableMeta(['name' => 'description', 'content' => 'bar']), $factory->description('bar'));
    $this->assertEquals(new ImmutableMeta(['name' => 'author', 'content' => 'bar']), $factory->author('bar'));
    $this->assertEquals(new ImmutableMeta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0']), $factory->viewport());
    $this->assertEquals(new ImmutableMeta(['name' => 'viewport', 'content' => 'bar']), $factory->viewport('bar'));
    $this->assertEquals(new ImmutableMeta(['name' => 'application-name', 'content' => 'bar']), $factory->applicationName('bar'));
    $this->assertEquals(new ImmutableMeta(['name' => 'keywords', 'content' => 'bar,baz']), $factory->keywords('bar', 'baz'));
    $this->assertEquals(new ImmutableMeta(['name' => 'keywords', 'content' => 'bar,baz']), $factory->keywords('bar,baz'));
    $this->assertEquals(new ImmutableMeta(['name' => 'keywords', 'content' => 'bar,baz']), $factory->namedContent('keywords', 'bar,baz'));
    $this->assertEquals(new ImmutableMeta(['http-equiv' => 'default-style', 'content' => 'foo']), $factory->defaultStyle('foo'));
    $this->assertEquals(new ImmutableMeta(['http-equiv' => 'refresh', 'content' => 1]), $factory->refresh(1));
  }

  public function testLinkFactoring(): void {
    $factory = MetaFactory::build();

    $this->assertEquals(new ImmutableLinkData([
                'rel' => 'stylesheet',
                'href' => 'foo.css',
                'media' => 'bar',
                'type' => 'text/css']), $factory->stylesheet('foo.css', 'bar'));
    $this->assertEquals(new ImmutableLinkData([
                'rel' => 'apple-touch-icon',
                'href' => 'foo.png',
                'sizes' => '16x16',
                'type' => 'image/png']), $factory->appleTouchIcon('foo.png', '16x16'));
    $this->assertEquals(new ImmutableLinkData([
                'rel' => 'manifest',
                'href' => 'manifest.json']), $factory->manifest('manifest.json'));
    $this->assertEquals(new ImmutableLinkData([
                'rel' => 'mask-icon',
                'href' => 'mask.svg',
                'color' => '#ffffff']), $factory->maskIcon('mask.svg', '#ffffff'));
    $this->assertEquals(new ImmutableLinkData([
                'rel' => 'preload',
                'href' => 'a.css',
                'crossorigin' => 'anonymous',
                'type' => Mime::getMime('a.css'),
                'as' => Mime::getContentType('a.css')]), $factory->preload('a.css', 'anonymous'));
  }

}
