<?php

// session_start();


function checkAuth()
{

    if(!isset($_SESSION['user_id']))
    {

        header("Content-Type: application/json");

        echo json_encode([

            "success"=>false,

            "message"=>"Unauthorized Access"

        ]);

        exit;

    }

}

?>