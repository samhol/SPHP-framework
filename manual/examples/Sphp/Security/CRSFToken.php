<?php

namespace Sphp\Security;

$token = new CRSFToken();
$value = $token->generateToken('csrf_token');
?>
<form>
...
<input type="hidden" name="csrf_token" value="<?php echo $value; ?>">
...
</form>
