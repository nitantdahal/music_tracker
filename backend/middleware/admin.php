<?php

require_once "auth.php";


function checkAdmin()
{

    checkAuth();


    if($_SESSION['role'] !== "admin")
    {

        header("Content-Type: application/json");


        echo json_encode([

            "success"=>false,

            "message"=>"Admin Access Required"

        ]);


        exit;

    }

}

?>