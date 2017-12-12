var $fname = "Sami",
        $user = {};
$user.fname = $fname;
$user.lname = "Holck";

function printUser(user) {
  document.write("<b>User:</b> " + user.fname + " " + user.lname + "<br>");
}
printUser($user);
