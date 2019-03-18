<?php
$sb = new Sphp\Html\Foundation\Sites\Forms\Inputs\SwitchBoard;
$sb->appendNewSwitch('Singular', 's', null);
$sb->appendNewSwitch('Plural', 'p', null);
$sb->appendNewSwitch('Messages', 'msg', null);
$sb->appendNewSwitch('Message IDs', 'id', null);
$sb->setDescription('Select used fields');
$dd = new Sphp\Html\Foundation\Sites\Containers\Dropdown('Options', $sb);
$dd->closeOnBodyClick(true);
$dd->setOption('data-v-offset', 3);
$dd->getTrigger()->addCssClass('button', 'radius');
$dd->getDropdown()->addCssClass('shadow', 'radius');
echo $dd;
?>
<div class="callout sphp switch-board" data-switch-board>
  <p class="note">Select used fields</p>
  <div class="switch-toggle-wrapper">
    <div class="switch">
      <input class="switch-input" id="all" type="checkbox" name="all" data-toggle-all>
      <label class="switch-paddle" for="all">
        <span class="show-for-sr">Toggle All</span>
      </label>
    </div>
    <label for="all">Toggle All</label>
  </div>

  <section class="options">
    <div class="switch-toggle-wrapper">
      <div class="switch">
        <input class="switch-input" id="singular" type="checkbox" name="singular">
        <label class="switch-paddle" for="singular">
          <span class="show-for-sr">Singular</span>
        </label>
      </div>
      <label for="singular">Singular</label>
    </div>

    <div class="switch-toggle-wrapper">
      <div class="switch">
        <input class="switch-input" id="plural" type="checkbox" name="plural">
        <label class="switch-paddle" for="plural">
          <span class="show-for-sr">Plural</span>
        </label>
      </div>
      <label for="plural">Plural</label>
    </div>
    <hr>
    <div class="switch-toggle-wrapper">
      <div class="switch">
        <input class="switch-input" id="msg" type="checkbox" name="msg">
        <label class="switch-paddle" for="msg">
          <span class="show-for-sr">Messages</span>
        </label>
      </div>
      <label for="msg">Messages</label>
    </div>

    <div class="switch-toggle-wrapper">
      <div class="switch">
        <input class="switch-input" id="id" type="checkbox" name="id">
        <label class="switch-paddle" for="id">
          <span class="show-for-sr">Message IDs</span>
        </label>
      </div>
      <label for="id">Message IDs</label>
    </div>
  </section>
</div>