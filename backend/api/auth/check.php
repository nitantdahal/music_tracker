<?php


require_once "../../config/config.php";



if(isset($_SESSION['user_id']))
{


    echo json_encode([

        "success"=>true,

        "loggedIn"=>true,


        "user"=>[

            "id"=>$_SESSION['user_id'],

            "name"=>$_SESSION['name'],

            "email"=>$_SESSION['email'],

            "role"=>$_SESSION['role'],

            "instrument"=>$_SESSION['instrument']

        ]

    ]);


}

else
{


    echo json_encode([

        "success"=>false,

        "loggedIn"=>false,

        "message"=>"Not Logged In"

    ]);


}



exit;

?>