<?php
$cookieBanner = new Sphp\Html\Apps\CookieBanner();
echo $cookieBanner;

use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInput;

$input = new ValidableInput(\Sphp\Html\Forms\Inputs\FormControls::text('username'), 'username', 'required');
$input->setInlineLabel('<i class="fa fa-user"></i>');
?>
<form data-abide novalidate>
  <div data-abide-error class="alert callout" style="display: none;">
    <p><i class="fi-alert"></i> There are some errors in your form.</p>
  </div>
  <div class="form-icons">
    <h4>Register for an account</h4>
    php
    <?php
    echo $input;
    ?>
    <div class="grid-x">


      <div class="cell small-6">
        <label for="example3Input">Username</label>
        <div class="input-group">
          <label class="input-group-label" for="example3Input">
            <i class="fa fa-user"></i>
          </label>
          <input class="input-group-field" placeholder="Username" id="example3Input" type="text" required pattern="number"/>
        </div>
        <label class="form-error" data-form-error-for="example3Input">Yo, you had better fill this out, it's required.</label>
      </div>


      <div class="cell small-6">
        <label for="example3Input">Username</label>
        <div class="input-group">
          <label class="input-group-label" for="example3Input">

          </label>
          <input class="input-group-field" placeholder="Username" id="example3Input" type="text" required pattern="number"/>
        </div>
        <label class="form-error" data-form-error-for="example3Input">Yo, you had better fill this out, it's required.</label>
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