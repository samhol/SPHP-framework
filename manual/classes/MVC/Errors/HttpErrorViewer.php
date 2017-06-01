<?php

/**
 * HttpErrorViewer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\Errors;

use Sphp\Html\ContentInterface;
use Sphp\Stdlib\Path;
use Sphp\Html\Media\Size;
use Sphp\Html\Media\Img;
use Sphp\Http\HttpCode;

/**
 * Description of Viewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-10
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HttpErrorViewer implements ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var HttpCode 
   */
  private $code;

  public function __construct(HttpCode $code) {
    $this->code = $code;
  }

  public function getHtml(): string {
    $cont = new \Sphp\Html\MdContainer();
    $cont->append('#' . $this->code->getCode() . ': <small>' . $this->code->getMessage() . '</small>{.error}');
    $cont->append($this->code->getDescription());
    try {
      $cont->appendFile("manual/templates/{$this->code->getCode()}.md");
    } catch (Exception $ex) {
      $cont->appendFile('manual/templates/general.md');
    }
    $manual = Path::get()->http();
    $cont->append("* [SPHP framework]($manual){.error}");
    $cont->append('* [SPHP framework API](http://documentation.samiholck.com/apigen/){.error}');
    $cont->append('* Technical Contact: <a href="mailto:sami.holck@samiholck.com">sami.holck@samiholck.com</a>');
    $cont->append("\n".'<div class="row columns"><div class="http-code float-right">' . $this->code->getCode() . '</div></div>');
    $path = Path::get()->local('manual/pics/error.png');
    $s25 = new Size(25, 25);
    $s50 = new Size(50, 50);
    $s100 = new Size(100, 100);
    $s150 = new Size(150, 150);

    $i25 = Img::scaleToFit($path, $s25)->addCssClass('grow')->setLazy()->setAlt('25px');
    $i50 = Img::scaleToFit($path, $s50)->addCssClass('grow')->setLazy()->setAlt('50px');
    $i100 = Img::scaleToFit($path, $s100)->addCssClass('grow')->setLazy()->setAlt('100px');
    $i150 = Img::scaleToFit($path, $s150)->addCssClass('grow')->setLazy()->setAlt('150px');

    $cont[] = $i25;
    $cont[] = $i50;
    $cont[] = $i100;
    $cont[] = $i150;
    $cont[] = $i100;
    $cont[] = $i50;
    $cont[] = $i25;
    return $cont->getHtml();
  }

}
