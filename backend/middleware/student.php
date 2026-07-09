<?php

require_once "auth.php";


function checkStudent()
{

    checkAuth();


    if($_SESSION['role'] !== "student")
    {

        header("Content-Type: application/json");


        echo json_encode([

            "success"=>false,

            "message"=>"Student Access Required"

        ]);


        exit;

    }

}

?>