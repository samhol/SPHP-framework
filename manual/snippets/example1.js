var $fname = "Sami",
        $user = {};
$user.fname = $fname;
$user.lname = "Holck";

function printUser(user) {
  document.write("<b>User:</b> " + user.fname + " " + user.lname + "<br>");
}
function alertUser(user) {
  alert("User " + user.fname + " " + user.lname) + " is alerted!";
}
printUser($user);
