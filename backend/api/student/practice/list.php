<?php


require_once "../../../config/config.php";
require_once "../../../config/db.php";
require_once "../../../middleware/student.php";
require_once "../../../helpers/response.php";



checkStudent();



$student_id = $_SESSION['user_id'];



try
{


    $database = new Database();

    $conn = $database->connect();



    $query = "

    SELECT

    id,

    piece_name,

    duration_minutes,

    session_date,

    notes


    FROM practice_sessions


    WHERE student_id = :student_id


    ORDER BY session_date DESC


    ";



    $stmt = $conn->prepare($query);



    $stmt->bindParam(
        ":student_id",
        $student_id
    );



    $stmt->execute();



    $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);




    sendResponse(

        true,

        "Practice history loaded",

        $sessions

    );


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