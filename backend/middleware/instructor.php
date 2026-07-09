<?php

require_once "auth.php";


function checkInstructor()
{

    checkAuth();


    if($_SESSION['role'] !== "instructor")
    {

        header("Content-Type: application/json");


        echo json_encode([

            "success"=>false,

            "message"=>"Instructor Access Required"

        ]);


        exit;

    }

}

?>