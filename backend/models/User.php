<?php

require_once __DIR__ . "/../config/db.php";


class User
{

    private $conn;
    private $table = "users";


    public function __construct()
    {
        $database = new Database();

        $this->conn = $database->connect();
    }



    // Find user by email

    public function findByEmail($email)
    {

        $query = "
            SELECT 
                id,
                name,
                email,
                password,
                role,
                instrument,
                created_at

            FROM {$this->table}

            WHERE email = :email

            LIMIT 1
        ";


        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(
            ":email",
            $email
        );


        $stmt->execute();


        return $stmt->fetch(PDO::FETCH_ASSOC);

    }



    // Find user by ID

    public function findById($id)
    {

        $query = "
            SELECT
                id,
                name,
                email,
                role,
                instrument,
                created_at

            FROM {$this->table}

            WHERE id = :id

            LIMIT 1
        ";


        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(
            ":id",
            $id
        );


        $stmt->execute();


        return $stmt->fetch(PDO::FETCH_ASSOC);

    }



    // Create new user

    public function create($data)
    {

        $query = "

            INSERT INTO users
            (
                name,
                email,
                password,
                role,
                instrument
            )

            VALUES
            (
                :name,
                :email,
                :password,
                :role,
                :instrument
            )

        ";


        $stmt = $this->conn->prepare($query);



        $stmt->bindParam(
            ":name",
            $data['name']
        );


        $stmt->bindParam(
            ":email",
            $data['email']
        );


        $stmt->bindParam(
            ":password",
            $data['password']
        );


        $stmt->bindParam(
            ":role",
            $data['role']
        );


        $stmt->bindParam(
            ":instrument",
            $data['instrument']
        );


        return $stmt->execute();

    }



    // Get all users (Admin use)

    public function getAll()
    {

        $query = "

            SELECT
                id,
                name,
                email,
                role,
                instrument,
                created_at

            FROM users

            ORDER BY id DESC

        ";


        $stmt = $this->conn->prepare($query);


        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }



    // Delete user

    public function delete($id)
    {

        $query = "

            DELETE FROM users

            WHERE id = :id

        ";


        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(
            ":id",
            $id
        );


        return $stmt->execute();

    }


}

?>