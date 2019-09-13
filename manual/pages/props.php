<?php

use Sphp\Manual\Apps\Icons\DataFactory;
use Sphp\Manual\Apps\Icons\IconGroup;
use Sphp\Manual\Apps\Icons\FaIconGroup;

echo '<pre>';
$iconsData = DataFactory::fontawesomeFromYaml('/home/int48291/public_html/playground/manual/snippets/icons/fontawesome/icons.yml');
$controller = new \Sphp\Manual\Apps\Icons\FaGroupController($iconsData);
$types = ['fas' => 'Solid', 'far' => 'Regular', 'fab' => 'Brand'];
$typeMap = ['solid' => 'fas', 'regular' => 'far', 'brands' => 'fab'];
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING, ['default' => 'regular']);
if ($type === null) {
  $type = 'regular';
}
echo '</pre>';
$iconsData = $iconsData->filter(function(IconGroup $iconData) use ($type) {
  if ($iconData instanceof FaIconGroup) {
    return in_array($type, $iconData->getStyles());
  }
  return false;
});
$info = new Sphp\Manual\Apps\Icons\Views\InfoVievs();

echo '<div class="icon-info-popup">' . $info->createHtmlFor($iconsData->getGroup('address-book')) . "</div>";

//var_dump($iconsData);
//$show = $typeMap[$type];
use Sphp\Manual\Apps\Icons\Views\IconsView;

$cells = new IconsView();
$cells->setHeading('Fontawesome <small>Regular Icons</small>');
$devData = DataFactory::deviconsFromJson('/home/int48291/public_html/playground/manual/snippets/icons/devicon/devicon.json');
echo $cells->getHtmlFor($controller->getData($type));
echo (new IconsView())->getHtmlFor($iconsData);
?>

<div class="icon-group">
  <div class="add-people-header">
    <h6 class="header-title">
      Facebook icons
    </h6>
  </div>
  <div class="grid-x icon-section">
    <div class="small-12 medium-6 columns about-icon">
      <div class="icon">
        <i class="fab fa-facebook icon"></i>
      </div>
      <div class="about-icon-author">
        <p class="author-name">
          Facebook icon
        </p>
        <p class="icon-set">
          <strong>Icon Set:</strong> FontAwesome
        </p>
        <p class="author-mutual">
          <strong>Shahrukh Khan</strong> is a mutual friend.
        </p>
      </div>    
    </div>
    <div class="small-12 medium-6 cell functionality text-center">
      <div class="add-friend-action">
        <button class="button primary small">
          <i class="fa fa-user-plus" aria-hidden="true"></i>
          copy icon class
        </button>
        <button class="button secondary small">
          <i class="fa fa-user-times" aria-hidden="true"></i>
          copy PHP call
        </button>
      </div>
    </div>
  </div>
  <div class="row add-people-section">
    <div class="small-12 medium-6 columns about-people">
      <div class="icon-avatar">
        <img class="avatar-image" src="https://i.imgur.com/GHeazQ2.jpg" alt="Kishore Kumar">
      </div>
      <div class="about-people-author">
        <p class="author-name">
          Barack Obama
        </p>
        <p class="author-location">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
          Hawaii, United States
        </p>
        <p class="author-mutual">
          <strong>Hilary Clinton</strong> is a mutual friend.
        </p>
      </div>    
    </div>
    <div class="small-12 medium-6 columns add-friend">
      <div class="add-friend-action">
        <button class="button primary small">
          <i class="fa fa-user-plus" aria-hidden="true"></i>
          Add Friend
        </button>
        <button class="button secondary small">
          <i class="fa fa-user-times" aria-hidden="true"></i>
          Ignore
        </button>
      </div>
    </div>
  </div>
</div>

