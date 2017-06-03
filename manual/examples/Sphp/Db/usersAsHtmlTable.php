<?php

namespace Sphp\Db;

use Sphp\Objects\User as User;

$query = (new Query());
$query->from("users")->get("username, fname, lname")
        ->orderBy("lname ASC", "fname ASC")
        ->limit(15);

$users = [];
foreach ($query as $row) {
  $users[] = new User($row);
}

namespace Sphp\Html\Tables;

$table = new Table();
$table->thead()->append(["Username", "First name", "last name"]);
$tbody = $table->tbody();
foreach ($users as $user) {
  $table->tbody()->append($user->get(["username", "fname", "lname"]));
}
$table->printHtml();
