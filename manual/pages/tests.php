<?php

use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;

$username = ValidableInlineInput::text('username');
$username->setRequired(true);
$username->setLeftInlineLabel('<i class="fa fa-user"></i>');
$username->setLabel('Username');
$username->setPlaceholder('Username');
$username->setErrorMessage('Username is required!');
$username->setRequired(true);

$pwField = ValidableInlineInput::password('password');
$pwField->setRequired(true);
$pwField->setLeftInlineLabel('<i class="fas fa-key"></i>');
$pwField->setLabel('Password');
$pwField->setPlaceholder('Password');
$pwField->setErrorMessage('Password is required!');
$pwField->setRequired(true);


$form = new GridForm();
$form->liveValidate(true);

$nameRow = new BasicRow();
$nameRow->appendCell($username)->small(12);
$form->append($nameRow);

$pwRow = new BasicRow();
$pwRow->appendCell($pwField)->small(12);
$form->append($pwRow);

$form->appendHiddenVariable('hidden1', 'I am hidden!');

$buttonRow = new BasicRow();
$buttons = new ButtonGroup();
$buttons->appendSubmitter('Submit')->addCssClass('success');
$buttons->setExtended();
$buttonRow->appendCell($buttons);
$form->append($buttonRow);
$form->liveValidate();
echo $form;
?>

<?php
if (isset($_POST['submit_pass']) && $_POST['pass']) {
  $pass = $_POST['pass'];
  if ($pass == "123") {
    $_SESSION['password'] = $pass;
  } else {
    $error = "Incorrect Pssword";
  }
}

if (isset($_POST['page_logout'])) {
  unset($_SESSION['password']);
}
?>


<div id="wrapper">

  <?php
  if ($_SESSION['password'] == "123") {
    ?>
    <h1>Create Password Protected Webpage Using PHP, HTML And CSS</h1>
    <form method="post" action="" id="logout_form">
      <input type="submit" name="page_logout" value="LOGOUT">
    </form>
    <?php
  } else {
    ?>
    <form method="post" action="" id="login_form">
      <h1>LOGIN TO PROCEED</h1>
      <input type="password" name="pass" placeholder="*******">
      <input type="submit" name="submit_pass" value="DO SUBMIT">
      <p>"Password : 123"</p>
      <p><font style="color:red;"><?php echo $error; ?></font></p>
    </form>
    <?php
  }
  ?>

</div>