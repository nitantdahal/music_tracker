<?php


require_once "../middleware/auth.php";


checkAuth();



echo json_encode([

"success"=>true,

"message"=>"You are logged in"

]);


?>