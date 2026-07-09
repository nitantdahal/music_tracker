<?php

require_once "../../config/config.php";
require_once "../../config/db.php";
require_once "../../middleware/student.php";
require_once "../../helpers/response.php";


// Check student login

checkStudent();



$student_id = $_SESSION['user_id'];



$database = new Database();

$conn = $database->connect();



// ==========================
// Student Information
// ==========================


$userQuery = "

SELECT

id,
name,
email,
instrument

FROM users

WHERE id = :id

";


$stmt = $conn->prepare($userQuery);


$stmt->bindParam(
    ":id",
    $student_id
);


$stmt->execute();


$student = $stmt->fetch(PDO::FETCH_ASSOC);



// ==========================
// Total Practice Sessions
// ==========================


$sessionQuery = "

SELECT

COUNT(*) AS total_sessions,

COALESCE(
SUM(duration_minutes),
0
) AS total_minutes


FROM practice_sessions


WHERE student_id = :student_id

";



$stmt = $conn->prepare($sessionQuery);


$stmt->bindParam(
    ":student_id",
    $student_id
);


$stmt->execute();



$practice = $stmt->fetch(PDO::FETCH_ASSOC);



// Convert minutes to hours

$total_hours = round(
    $practice['total_minutes'] / 60,
    2
);



// ==========================
// Goal Statistics
// ==========================


$goalQuery = "

SELECT

COUNT(*) AS total_goals,


SUM(
CASE 
WHEN status='achieved'
THEN 1
ELSE 0
END
)

AS completed_goals


FROM goals


WHERE student_id=:student_id

";



$stmt = $conn->prepare($goalQuery);


$stmt->bindParam(
    ":student_id",
    $student_id
);


$stmt->execute();



$goals = $stmt->fetch(PDO::FETCH_ASSOC);



if($goals['completed_goals']==null)
{
    $goals['completed_goals']=0;
}



// ==========================
// Streak Information
// ==========================


$streakQuery = "

SELECT

current_streak,

longest_streak


FROM streaks


WHERE student_id=:student_id


LIMIT 1

";



$stmt=$conn->prepare($streakQuery);


$stmt->bindParam(
    ":student_id",
    $student_id
);


$stmt->execute();



$streak=$stmt->fetch(PDO::FETCH_ASSOC);



if(!$streak)
{

    $streak=[

        "current_streak"=>0,

        "longest_streak"=>0

    ];

}




// ==========================
// Recent Practice Sessions
// ==========================


$recentQuery="

SELECT

id,

piece_name,

duration_minutes,

session_date,

notes


FROM practice_sessions


WHERE student_id=:student_id


ORDER BY session_date DESC


LIMIT 5


";



$stmt=$conn->prepare($recentQuery);


$stmt->bindParam(
    ":student_id",
    $student_id
);


$stmt->execute();



$recent_sessions=$stmt->fetchAll(PDO::FETCH_ASSOC);




// ==========================
// Final Response
// ==========================



sendResponse(

true,

"Dashboard Data Loaded",


[

    "student"=>$student,


    "statistics"=>[

        "total_sessions"=>(int)$practice['total_sessions'],

        "total_hours"=>$total_hours,

        "current_streak"=>(int)$streak['current_streak'],

        "longest_streak"=>(int)$streak['longest_streak']

    ],


    "goals"=>[

        "total_goals"=>(int)$goals['total_goals'],

        "completed_goals"=>(int)$goals['completed_goals']

    ],


    "recent_sessions"=>$recent_sessions


]

);


?>