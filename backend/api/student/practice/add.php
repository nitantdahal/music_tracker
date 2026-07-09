<?php

require_once "../../../config/config.php";
require_once "../../../config/db.php";
require_once "../../../middleware/student.php";
require_once "../../../helpers/response.php";


// Check student authentication

checkStudent();



header("Content-Type: application/json");



// Get JSON data

$data = json_decode(
    file_get_contents("php://input"),
    true
);



if(!$data)
{

    sendResponse(

        false,

        "Invalid JSON data",

        []

    );

    exit;

}




// Receive values

$piece_name = $data['piece_name'] ?? '';

$duration_minutes = $data['duration_minutes'] ?? '';

$session_date = $data['session_date'] ?? '';

$notes = $data['notes'] ?? '';



$student_id = $_SESSION['user_id'];




// Validation

if(
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





try{


    $database = new Database();

    $conn = $database->connect();



    $query = "

    INSERT INTO practice_sessions

    (

        student_id,

        piece_name,

        duration_minutes,

        session_date,

        notes

    )

    VALUES

    (

        :student_id,

        :piece_name,

        :duration_minutes,

        :session_date,

        :notes

    )

    ";




    $stmt = $conn->prepare($query);



    $stmt->bindParam(
        ":student_id",
        $student_id
    );


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




    if($stmt->execute())
    {


        sendResponse(

            true,

            "Practice session added successfully",

            [

                "id"=>$conn->lastInsertId()

            ]

        );


    }

    else
    {


        sendResponse(

            false,

            "Failed to add practice session",

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