<?php

$hash = '$2y$10$mro4mBjUSVtJSk9uIUK/FOXNSNVFjWjuYo9Av2yqcTqiJ4f1Vy2GO';

if(password_verify("123456", $hash)){
    echo "Password Correct";
}else{
    echo "Password Incorrect";
}