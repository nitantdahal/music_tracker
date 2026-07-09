<?php


require_once "models/User.php";


$user = new User();


$result = $user->findByEmail(
    "student@gmail.com"
);


echo "<pre>";

print_r($result);

echo "</pre>";

?>