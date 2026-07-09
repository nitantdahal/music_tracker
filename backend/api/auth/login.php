<?php

// session_start();

require_once "../../config/config.php";
require_once "../../helpers/response.php";
require_once "../../helpers/validator.php";
require_once "../../models/User.php";


// Allow only POST requests

if($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    sendResponse(
        false,
        "Invalid Request Method"
    );
}



// Get JSON Data

$data = json_decode(
    file_get_contents("php://input"),
    true
);



$email = sanitize($data['email'] ?? '');

$password = sanitize($data['password'] ?? '');



// Validate empty fields

if(isEmpty($email) || isEmpty($password))
{
    sendResponse(
        false,
        "Email and Password are required"
    );
}



// Validate email

if(!isValidEmail($email))
{
    sendResponse(
        false,
        "Invalid Email Format"
    );
}



// Create User Model

$userModel = new User();



// Find User

$user = $userModel->findByEmail($email);



if(!$user)
{
    sendResponse(
        false,
        "User not found"
    );
}



// Verify Password

if(!password_verify($password,$user['password']))
{
    sendResponse(
        false,
        "Invalid Password"
    );
}



// Create Session

$_SESSION['user_id'] = $user['id'];

$_SESSION['name'] = $user['name'];

$_SESSION['email'] = $user['email'];

$_SESSION['role'] = $user['role'];

$_SESSION['instrument'] = $user['instrument'];



// Remove password before sending response

unset($user['password']);



// Successful Response

sendResponse(
    true,
    "Login Successful",
    $user
);

?>