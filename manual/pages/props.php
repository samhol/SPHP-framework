<div class="card card-reveal-wrapper">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" height="300px"><title>angularjs-plain</title>
    <path fill="#C4473A" d="M52.864 64h23.28l-12.375-25.877zM63.81 1.026l-59.257 20.854 9.363 77.637 49.957 27.457 50.214-27.828 9.36-77.635-59.637-20.485zm-15.766 73.974l-7.265 18.176-13.581.056 36.608-81.079-.07-.153h-.064l.001-.133.063.133h.14100000000000001l.123-.274v.274h-.124l-.069.153 38.189 81.417-13.074-.287-8.042-18.58-17.173.082"></path></svg>
  <div class="card-section">
    <i class="fa fa-angle-up open-button"><span class="show-for-sr">More</span></i>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga et voluptas, praesentium temporibus est? Recusandae blanditiis eaque ea quam omnis, expedita amet, et eius ipsum quod ipsa, veritatis doloribus enim.</p>
    <div class="card-reveal">
      <span class="card-reveal-title">
        <h4>Card Title</h4>
        <i class="fa fa-angle-down close-button"><span class="show-for-sr">Close</span></i>
      </span>
      <p>Here is some more information. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>
    </div> <!-- /.card-reveal -->
  </div> <!-- /.card-section -->
</div> <!-- /.card -->

<?php
$card = new Sphp\Html\Foundation\Sites\Containers\CardReveal();

use Sphp\Html\Media\Icons\FontAwesome;

$fa = new FontAwesome;

$card->getTop()->append(FontAwesome::i('fas fa-bug')->setSize('4x')->addCssClass('text-center'));
$fa->fixedWidth();
$fa->useBorders(true);
$card->getTop()->appendMd('### Bugs are bad{.text-center}');
$card->getRevealTitle()->appendMd('### More information about bugs');
$card->setOpenIcon($fa('fa fa-angle-up'));
$card->setCloseIcon($fa('fa fa-angle-down'));
$card->getReveal()->appendMd('Here is some more information. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.');
echo $card;
