<?php


require_once "../middleware/admin.php";


checkAdmin();



echo json_encode([

"success"=>true,

"message"=>"Welcome Admin"

]);


?>