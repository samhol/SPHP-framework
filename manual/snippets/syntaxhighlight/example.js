var $user = {};
$user.fname = "Sami";
$user.lname = "Holck";

function alertUser(user) {
  alert(user.fname + " " + user.lname);
}

function logUser(user) {
  console.log(user.fname + " " + user.lname);
}

alertUser($user);
logUser($user);
