<?php

require_once "backend/config/db.php";

$db = new Database();

$conn = $db->connect();

if($conn){
    echo "Database Connected Successfully";
}