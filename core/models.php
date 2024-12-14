<?php
require_once 'dbconfig.php';

function getallappli($pdo){
    $sql = "SELECT * FROM shoe_store ORDER BY first_name ASC";
    $stmt = $pdo->prepare($sql);
    $executequery = $stmt->execute();
    if ($executequery) {
        return $stmt->fetchAll(); 
    }
    return [];
}

function getapplibyID($pdo, $job_id) {
    $sql = "SELECT * FROM shoe_store WHERE job_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$job_id]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
    return null; 
}

function searchforappli($pdo, $searchquery) {
    $searchquery = "%" . strtolower($searchquery) . "%";
    $sql = "SELECT * FROM shoe_store WHERE 
            CONCAT(first_name, last_name, position, email, gender, home_address, nationality, date_added)
            LIKE ?";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$searchquery]);

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
    return []; 
}

function insertnewappli($pdo, $first_name, $last_name, $position, $email, $gender, $home_address, $nationality) {
    $response = array();
    $checkappli = checkappli($pdo, $first_name);

    if (!$checkappli['result']) {
        $sql = "INSERT INTO shoe_store (first_name, last_name, position, email, gender, home_address, nationality) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$first_name, $last_name, $position, $email, $gender, $home_address, $nationality])) {
            $response = array(
                "status" => "200",
                "message" => "Successfully inserted"
            );
        } else {
            $response = array(
                "status" => "400",
                "message" => "Error inserting data"
            );
        }
    } else {
        $response = array(
            "status" => "400",
            "message" => "User already exists"
        );
    }
    return $response;
}

function editappli($pdo, $first_name, $last_name, $position, $email, $gender, $home_address, $nationality, $job_id) {
    $sql = "UPDATE shoe_store
            SET first_name = ?, last_name = ?, position = ?, email = ?, gender = ?, home_address = ?, nationality = ?
            WHERE job_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $position, $email, $gender, $home_address, $nationality, $job_id]);

    if ($executeQuery) {
        return true;
    }
    return false;
}

function deleteappli($pdo, $job_id) {
    $sql = "DELETE FROM shoe_store WHERE job_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$job_id]);

    if ($executeQuery) {
        return true;
    }
    return false; 
}

function checkappli($pdo, $first_name) {
    $response = array();
    $sql = "SELECT * FROM shoe_store WHERE first_name = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$first_name])) {
        $userInfoArray = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            $response = array(
                "result" => true,
                "status" => "200",
                "userInfoArray" => $userInfoArray
            );
        } else {
            $response = array(
                "result" => false,
                "status" => "400",
                "message" => "User doesn't exist"
            );
        }
    }

    return $response;
}
?>
