<?php
$cookieBanner = new Sphp\Html\Apps\CookieBanner();
echo $cookieBanner;

use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;

$username = ValidableInlineInput::text('username');
$username->setRequired(true);
$username->setInlineLabel('<i class="fa fa-user"></i>');
$username->setLabel('Username');
$username->setPlaceholder('Username');
$username->setErrorMessage('Username is required!');
$username->setRequired(true);

$fname = ValidableInlineInput::text('fname');
$fname->setRequired(true);
$fname->setInlineLabel('<i class="fa fa-user"></i>');
$fname->setLabel('First name');
$fname->setPlaceholder('First name');
$fname->setErrorMessage('First name is required!');
$fname->setRequired(true);

$lname = ValidableInlineInput::text('lname');
$lname->setRequired(true);
$lname->setInlineLabel('<i class="fa fa-user"></i>');
$lname->setLabel('Last name');
$lname->setPlaceholder('Last name');
$lname->setErrorMessage('Last name is required!');
$lname->setRequired(true);

$carSelector = ValidableInlineInput::select('Favourite car');
$carSelector->appendOption(null);
$carSelector->appendOption('saab', 'Saab');
$carSelector->appendOption('volvo', 'Volvo');
$carSelector->appendOption('ferrari', 'Ferrari');
$carSelector->setErrorMessage('A car model is required');
$carSelector->setRequired(true);
$carSelector->setInlineLabel('<i class="fas fa-car"></i>');


$carPrice = ValidableInlineInput::text('car_price');
$carPrice->setRequired(true);
$carPrice->setInlineLabel('<i class="fa fa-user"></i>');
$carPrice->setLabel('Suitable price');
$carPrice->setPlaceholder('10.000');
$carPrice->setErrorMessage('Car price is required and must be a decimal number!');
$carPrice->setRequired(true);

$form = new GridForm();
$form->validation(true);
$form->append($username);

$nameRow = new BasicRow();
$nameRow->appendCell($fname)->small(12)->medium(6);
$nameRow->appendCell($lname)->small(12)->medium(6);
$form->append($nameRow);


$carRow = new BasicRow();
$carRow->appendCell($carSelector)->small(12)->medium(6);
$carRow->appendCell($carPrice)->small(12)->medium(6);
$form->append($carRow);

echo $form;
?>
<form data-abide novalidate>
  <h4>Register for an account</h4>
  <div data-abide-error class="alert callout" style="display: none;">
    <p><i class="fi-alert"></i> There are some errors in your form.</p>
  </div>
  <div>
    <?php
    echo $username . $carSelector;
    ?>
    <div class="grid-x">


      <div class="cell small-6">
        <label for="ss">Username</label>
        <div class="input-group">
          <label class="input-group-label" for="ss">
            <i class="fa fa-user"></i>
          </label>
          <input class="input-group-field" id="ss" placeholder="Username" type="text" required pattern="number">
        </div>
        <label for="ss" class="form-error" data-form-error-for="ss">Yo, you had better fill this out, it's required.</label>
      </div>


      <div class="cell small-6">
        <label for="aaa">Username</label>
        <div class="input-group">
          <label class="input-group-label" for="aaa">

          </label>
          <input class="input-group-field" placeholder="Username" id="aaa" type="text" required pattern="number"/>
        </div>
        <label class="form-error" data-form-error-for="aaa">Yo, you had better fill this out, it's required.</label>
      </div>
    </div>

    <div class="cell small-6">
      <label for="ee">Fullname</label>
      <div class="input-group">
        <label class="input-group-label" for="ee">
          <i class="fa fa-user"></i>
        </label>
        <input class="input-group-field" placeholder="Fullname" id="ee" type="text" required pattern="alpha"/>
      </div>
      <label class="form-error" data-form-error-for="ee">Full name is required.</label>
    </div>

    <div class="input-group">
      <span class="input-group-label">
        <i class="fa fa-envelope"></i>
      </span>
      <input class="input-group-field" type="text" placeholder="Email">
    </div>

    <div class="input-group">
      <span class="input-group-label">
        <i class="fa fa-key"></i>
      </span>
      <input class="input-group-field" type="text" placeholder="Password">
    </div>
  </div>

  <button class="button expanded">Sign Up</button>
</form>