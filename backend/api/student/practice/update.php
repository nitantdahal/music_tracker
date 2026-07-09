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

$piece_name = $data['piece_name'] ?? '';

$duration_minutes = $data['duration_minutes'] ?? '';

$session_date = $data['session_date'] ?? '';

$notes = $data['notes'] ?? '';



$student_id = $_SESSION['user_id'];





if(
empty($id) ||
empty($piece_name) ||
empty($duration_minutes) ||
empty($session_date)
)
{

    sendResponse(
        false,
        "Required fields missing",
        []
    );

    exit;

}




try
{


$database = new Database();

$conn = $database->connect();



$query = "

UPDATE practice_sessions

SET

piece_name = :piece_name,

duration_minutes = :duration_minutes,

session_date = :session_date,

notes = :notes


WHERE

id = :id

AND

student_id = :student_id

";



$stmt = $conn->prepare($query);



$stmt->bindParam(
":piece_name",
$piece_name
);


$stmt->bindParam(
":duration_minutes",
$duration_minutes
);


$stmt->bindParam(
":session_date",
$session_date
);


$stmt->bindParam(
":notes",
$notes
);


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

"Practice session updated successfully",

[]

);


}

else
{


sendResponse(

false,

"Update failed",

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