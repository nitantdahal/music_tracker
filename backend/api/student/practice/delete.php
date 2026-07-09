<?php


require_once "../../../config/config.php";
require_once "../../../config/db.php";
require_once "../../../middleware/student.php";
require_once "../../../helpers/response.php";


checkStudent();


header("Content-Type: application/json");



$data = json_decode(
    file_get_contents("php://input"),
    true
);



if(!$data)
{

    sendResponse(
        false,
        "Invalid data",
        []
    );

    exit;

}



$id = $data['id'] ?? '';



$student_id = $_SESSION['user_id'];



if(empty($id))
{

    sendResponse(
        false,
        "Practice ID required",
        []
    );

    exit;

}




try
{


$database = new Database();

$conn = $database->connect();



$query = "

DELETE FROM practice_sessions

WHERE id = :id

AND student_id = :student_id

";



$stmt = $conn->prepare($query);



$stmt->bindParam(
":id",
$id
);



$stmt->bindParam(
":student_id",
$student_id
);



if($stmt->execute())
{


sendResponse(

true,

"Practice session deleted successfully",

[]

);


}

else
{


sendResponse(

false,

"Delete failed",

[]

);


}



}

catch(PDOException $e)
{


sendResponse(

false,

$e->getMessage(),

[]

);


}



?>