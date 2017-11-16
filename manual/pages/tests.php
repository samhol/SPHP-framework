<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Foundation\Sites\Grids\XY\BlockGrid;
use Sphp\Html\Foundation\Sites\Adapters;

$bg = (new BlockGrid('small-up-1', 'medium-up-2', 'xlarge-up-4'))
        ->setColumns([
    'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.',
    'b',
    'c ehbrte aer we raawer  awra wrta a',
    'd',
    'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egest  s sd se sese  sse s s gs res rs rsr s r ssr t ss rs rsr s  sr t srgsr r srteas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.']);
$eq = new Adapters\Equalizer($bg);
foreach ($bg as $col) {
  $eq->addObserver($col);
}
$eq->equalizeOn('medium')->equalizeByRow();
echo '<div class="grid-example">' . $bg . '<pre>';

echo "</pre>";
?>
<div class="grid-x grid-padding-x">
  <div class="cell small-3 align-self-bottom ">
    <div class="demo">Align bottom</div>
  </div>
  <div class="cell small-3 align-self-middle align-right">
    <div class="grid-x grid-padding-x align-right"> <!-- Aligned to the left -->
      <div class="cell small-4">Aligned to</div>
      <div class="cell small-4">the right</div>
    </div>
  </div>
  <div class="cell small-3 align-self-stretch">
    <div class="demo">Align stretch</div></div>
  <div class="cell small-3 align-self-top">
    <div class="demo">Align top. Lorem ipsum dolor sit amet, consectetur 
      adipisicing elit. Non harum laborum cum voluptate vel, eius adipisci 
      similique dignissimos nobis at excepturi incidunt fugit molestiae 
      quaerat, consequuntur porro temporibus. Nisi, ex?</div>
  </div>
</div>
</div>

<form>
  <div class="grid-container">
    <div class="grid-x grid-padding-x">
      <div class="medium-6 cell">
        <label>Input Label
          <input type="text" placeholder=".medium-6.cell">
        </label>
      </div>
      <div class="medium-6 cell">
        <label>Input Label
          <input type="text" placeholder=".medium-6.cell">
        </label>
      </div>
    </div>
  </div>
</form>
<?php

namespace Sphp\Html\Foundation\Sites\Core;

$sc = new ScreenSizes();

var_dump($sc->toArray());
var_dump($sc->getPreviousSize('medium'));
var_dump($sc->getNextSize('medium'));

namespace Sphp\Html\Foundation\Sites\Adapters;

$inter = new Interchange(new \Sphp\Html\Div());

$inter->setQuery('xlarge', 'manual/snippets/loremipsum.html')
        ->setQuery('small', 'manual/snippets/loremipsum.html')
        ->setQuery('xxlarge', 'manual/snippets/sleep.php')
        ->printHtml();










