<?php
$cookieBanner = new Sphp\Html\Apps\CookieBanner();
echo $cookieBanner;
?>
<form data-abide novalidate>
  <div data-abide-error class="alert callout" style="display: none;">
    <p><i class="fi-alert"></i> There are some errors in your form.</p>
  </div>
  <div class="form-icons">
    <h4>Register for an account</h4>

    <div class="input-group">

      <label class="input-group-label" for="username">
        <i class="fa fa-user"></i>
      </label>
      <label class="input-group-field">
        <input class="input-group-field" id="username" type="text" placeholder="Username" aria-describedby="example1Hint1" aria-errormessage="example1Error1" required pattern="number">
        <span class="form-error" id="example1Error1">
          Yo, you had better fill this out, it's required.
        </span>
      </label>

    </div>

    <div>
      <div class="input-group">
        <label class="input-group-label" for="example3Input">
          <i class="fa fa-user"></i>
        </label>
        <input class="input-group-field" placeholder="Username" id="example3Input" type="text" required pattern="number"/>
      </div>
      <label class="form-error" data-form-error-for="example3Input">Yo, you had better fill this out, it's required.</label>
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