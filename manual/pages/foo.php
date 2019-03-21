<?php
$cookieBanner = new Sphp\Html\Apps\CookieBanner();
echo $cookieBanner;

use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;

$input = new ValidableInlineInput(\Sphp\Html\Forms\Inputs\FormControls::text('username'), 'username', 'required');
$input->setInlineLabel('<i class="fa fa-user"></i>');
$input->setLabel('Username');
$input->setPlaceholder('Username');
$input->setErrorMessage('Username is required!');
$input->setRequired(true);

$select = ValidableInlineInput::select('Favourite car');
$select->appendOption(null);
$select->appendOption('saab', 'Saab');
$select->appendOption('volvo', 'Volvo');
$select->appendOption('ferrari', 'Ferrari');
$select->setErrorMessage('A car model is required');
$select->setRequired(true);
$select->setInlineLabel('<i class="fas fa-car"></i>');
?>
<form data-abide novalidate>
  <h4>Register for an account</h4>
  <div data-abide-error class="alert callout" style="display: none;">
    <p><i class="fi-alert"></i> There are some errors in your form.</p>
  </div>
  <div>
    <?php
    echo $input.$select;
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